<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'invoice_id',
        'receipt_number',
        'receipt_name',
        'receipt_save_path',
        'receipt_date',
        'receipt_due_date',

    ];
}