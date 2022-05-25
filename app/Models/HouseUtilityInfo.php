<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseUtilityInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'utility_name',
        'account_no',
        'user_account_id',
        'user_account_password',
        'biller_code',
        'last_payment_date',
        'created_by'
    ];

    public function setLastPaymentDateAttribute($value)
    {
        $this->attributes['last_payment_date'] = Carbon::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d');
    }

    public function getLastPaymentDateAttribute($date)
    {
        if($date != null){
            $date = new Carbon($date);
            return $date->format('d/m/Y');
        }

        return $date;
    }
}
