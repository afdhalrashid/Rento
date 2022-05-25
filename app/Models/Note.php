<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notes',
        'colorid',
        'created_by',
    ];

    public function getCreatedAtAttribute($date)
    {
        if($date != null){
            $date = new Carbon($date);
            return $date->format('d/m/Y');
        }

        return $date;
    }
}