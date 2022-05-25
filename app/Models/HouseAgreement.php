<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'name',
        'file_path',
        'file_for'
    ];
}
