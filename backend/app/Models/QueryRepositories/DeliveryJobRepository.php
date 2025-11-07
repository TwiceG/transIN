<?php

namespace App\Models\QueryRepositories;

use App\Models\DeliveryJob;
use Illuminate\Support\Facades\DB;
use App\Enums\DeliveryStatus;




class DeliveryJobRepository
{
    public function getJobs()
    {
        return DeliveryJob::all();
    }

    public function createDeliveryJob($data)
    {
        $status = DeliveryStatus::ACCEPTED->value;
        $adminId = 1;

        $data = array_merge($data, [
            'status' => $status,
            'user_id' => $adminId,
        ]);

        return DeliveryJob::create($data);
    }

    public function updateDeliveryJob($id, $data)
    {
        $job = DeliveryJob::find($id);
        if (!$job) {
            return null;
        }

        $job->update($data);
        return $job;
    }

    public function assignDriver($data)
    {
        $jobId = $data['job_id'];
        $job = DeliveryJob::find($jobId);

        if (!$job) {
            return null;
        }

        $job->update([
            'user_id' => $data['driver_id']
        ]);

        return $job;
    }

    public function listJobsByDriver($driverId)
    {
        return DeliveryJob::where('user_id', $driverId)->get();
    }

    public function updateDeliveryStatus($data)
    {
        $jobId = $data['job_id'];
        $job = DeliveryJob::find($jobId);

        if (!$job) {
            return null;
        }

        $job->update([
            'status' => $data['status']
        ]);

        return $job;
    }
}
