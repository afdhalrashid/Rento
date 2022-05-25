<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class role extends Model
{
    use HasFactory;

    // public function Permissions()
    // {
    //     return $this->hasMany(Permission::class);
    // }
}
