<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseOwnerBankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'bank_name',
        'account_no',
        'account_name'
    ];
}