<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementReceiver extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'house_id'
    ];

    public function house()
    {
        return $this->hasMany(House::class);
    }
}