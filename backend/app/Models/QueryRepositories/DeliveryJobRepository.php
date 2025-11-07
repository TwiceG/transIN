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
}
