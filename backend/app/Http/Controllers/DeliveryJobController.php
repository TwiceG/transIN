<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueryRepositories\DeliveryJobRepository;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class DeliveryJobController extends Controller
{
    protected $deliveryJobRepo;

    public function __construct(DeliveryJobRepository $deliveryJobRepo)
    {
        $this->deliveryJobRepo = $deliveryJobRepo;
    }


    // Convert camelCase keys from frontend to snake_case for database
    private function toSnakeKeys($data)
    {
        return collect($data)
            ->mapWithKeys(fn($v, $k) => [Str::snake($k) => $v])
            ->toArray();
    }



    // Admin activities 
    public function listAllJobs()
    {
        return $this->deliveryJobRepo->getJobs();
    }

    public function createDeliveryJob(Request $request)
    {
        $data = $this->toSnakeKeys($request->validate([
            'startingAddress' => 'required|string',
            'destinationAddress' => 'required|string',
            'recipientName' => 'required|string',
            'recipientPhone' => 'required|string',
        ]));

        $job = $this->deliveryJobRepo->createDeliveryJob($data);

        if (!$job) {
            return response()->json(
                [
                    'message' => 'Failed to create delivery job.'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json([
            'message' => 'Delivery job created successfully.',
            'job' => $job,
        ], Response::HTTP_CREATED,);
    }

    public function updateDeliveryJob(Request $request, $jobId)
    {
        $data = $this->toSnakeKeys($request->validate([
            'startingAddress' => 'sometimes|string',
            'destinationAddress' => 'sometimes|string',
            'recipientName' => 'sometimes|string',
            'recipientPhone' => 'sometimes|string',
            'status' => 'sometimes|string|in:accepted,distributed,in_transit,delivered,failed',
        ]));

        $job = $this->deliveryJobRepo->updateDeliveryJob($jobId, $data);

        if (!$job) {
            return response()->json(['message' => 'Delivery job not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'message' => 'Delivery job updated successfully',
            'job' => $job
        ], Response::HTTP_OK);
    }

    public function assignDriver(Request $request)
    {
        $data = $this->toSnakeKeys($request->validate([
            'driverId' => 'required',
            'jobId' => 'required',
        ]));

        $job = $this->deliveryJobRepo->assignDriver($data);

        if (!$job) {
            return response()->json(['message' => 'Delivery job not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'message' => "Driver {$data['driver_id']} has been assigned to job {$data['job_id']}.",
            'job' => $job
        ], Response::HTTP_OK);
    }

    // Driver activities
    public function listDriverJobs($driverId)
    {
        return $this->deliveryJobRepo->listJobsByDriver($driverId);
    }
}
