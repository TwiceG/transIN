<?php

namespace App\Enums;

enum DeliveryStatus: string
{
    case DISTRIBUTED = 'distributed';
    case IN_TRANSIT = 'in_transit';
    case DELIVERED = 'delivered';
    case FAILED = 'failed';
    case ACCEPTED = 'accepted';
}
