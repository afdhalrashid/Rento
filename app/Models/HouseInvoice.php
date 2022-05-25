<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'tenant_id',
        'invoice_number',
        'invoice_name',
        'invoice_save_path',
        'invoice_date',
        'invoice_due_date',

    ];

    protected $with = ['invoice_items','bank_account','receipt','payment_attachments'];

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class,'invoice_id','id');
    }

    public function bank_account()
    {
        return $this->hasOne(HouseOwnerBankAccount::class,'id','bank_account_id');
    }

    public function receipt()
    {
        return $this->hasOne(HouseReceipt::class,'invoice_id','id');
    }

    public function payment_attachments()
    {
        return $this->hasOne(InvoiceTenantPaymentAttachment::class,'invoice_id','id');
    }
}