<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class SOP extends Model
{
    use HasFactory;

    protected $appends = ['created_by'];

    protected $fillable = [
        'sop_name',
        'file_name',
        'file_path',
        'file_for',
        'created_by',
    ];

    public function getCreatedByAttribute($value)
    {
        if($value != null){
            $user = User::select('name')->where('id', $value)->first();
            $name = $user['name'];
            return $name;
        }
        return $value;
    }
}