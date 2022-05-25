<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseAgreementLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'links',
        'created_by'
    ];
}