<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'brand',
        'type',
        'license_plate',
        'user_id',
    ];

    // The vechile is belongs to a driver
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
