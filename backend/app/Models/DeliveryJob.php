<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DeliveryStatus;

class DeliveryJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_address',
        'destination_address',
        'recipient_name',
        'recipient_phone',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => DeliveryStatus::class,
    ];

    // Each delivery job belongs to a driver after distributed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
