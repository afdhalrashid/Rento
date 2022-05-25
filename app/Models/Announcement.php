<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'announcement_date',
        'announcement_type',
        'created_by'
    ];

    public function setAnnouncementDateAttribute($value)
    {
        $this->attributes['announcement_date'] = Carbon::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d');
    }

    public function images()
    {
        return $this->hasMany(AnnouncementImage::class)->orderBy('image_index', 'asc');
    }

    public function getAnnouncementDateAttribute($date)
    {
        if($date != null){
            $date = new Carbon($date);
            return $date->format('d/m/Y');
        }

        return $date;
    }
}