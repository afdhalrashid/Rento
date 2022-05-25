<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTenantPaymentAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'image_index',
        'image_name',
        'image_path',
        'image_for'
    ];
}