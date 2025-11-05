<?php

namespace App\Models\QueryRepositories;

use App\Models\DeliveryJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DeliveryJobRepository
{
    public function getJobs()
    {
        return DeliveryJob::all();
    }
}
