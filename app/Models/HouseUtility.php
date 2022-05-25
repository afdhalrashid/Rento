<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseUtility extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'utility_type',
        'year',
        'month',
        'value',
        'image_name',
        'image_path',
        'remark',
        'payment_date'
    ];

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = Carbon::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d');
    }
}
