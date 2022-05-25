<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'image_index',
        'image_name',
        'image_path',
        'image_for'
    ];
}
