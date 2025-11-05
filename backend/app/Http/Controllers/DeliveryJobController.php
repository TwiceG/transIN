<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueryRepositories\DeliveryJobRepository;

class DeliveryJobController extends Controller
{
    protected $deliveryJobRepository;

    public function __construct(DeliveryJobRepository $deliveryJobRepository)
    {
        $this->deliveryJobRepository = $deliveryJobRepository;
    }


    public function listJobs()
    {
        return $this->deliveryJobRepository->getJobs();
    }
}
