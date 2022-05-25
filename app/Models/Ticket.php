<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'ticket_number',
        'ticket_id',
        'title',
        'priority',
        'message',
        'status',

    ];

    public function images()
    {
        return $this->hasMany(TicketImage::class, 'ticket_id', 'ticket_id')
            ->orderBy('image_index', 'asc');
    }

    public function parameterCategory()
    {
        return $this->hasOne(Parameter::class, 'type_id', 'category_id');
    }

    public function house_tenant()
    {
        return $this->hasOne(HouseTenant::class, 'tenant_user_id', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket_id', 'ticket_id')
            ->orderBy('updated_at', 'desc');
    }

    public function getCreatedAtAttribute($date)
    {
        if($date != null){
            $date = new Carbon($date);
            return $date->format('d/m/Y');
        }

        return $date;
    }
}