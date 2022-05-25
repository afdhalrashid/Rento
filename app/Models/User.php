<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'password',
        'date_subscribe',
        'period_before_end_subscribe',
        'date_expired',
        'email_verified_at',
        'created_by',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['houses'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class, 'created_by','id');
    }


    // public function roles()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function setDateSubscribeAttribute($value)
    {
        $this->attributes['date_subscribe'] = Carbon::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d');
    }

    public function getDateSubscribeAttribute($date)
    {
        if($date != null){
            $date = new Carbon($date);
            return $date->format('d/m/Y');
        }

        return $date;
    }

    public function getDateExpiredAttribute($date)
    {
        if($date != null){
            $date = new Carbon($date);
            return $date->format('d/m/Y');
        }

        return $date;
    }
}