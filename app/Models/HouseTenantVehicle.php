<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseTenantVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'vehicle_count',
        'vehicle_type',
    ];
}
