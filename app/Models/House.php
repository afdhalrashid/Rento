<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $with = ['parameter_state','invoiceImage'];

    protected $fillable = [
        'address1', 'address2', 'poskod', 'daerah', 'negeri', 'namaowner', 'icowner','phoneno_owner','email_owner', 'created_by'
    ];

    public function getNegeriAttr($value)
    {
        return Parameter::where('type_id', '=', $value)->where('parameter_name', '=', 'state')->first();
    }

    public function parameter_state()
    {
        return $this->belongsTo('App\Models\Parameter', 'negeri', 'type_id');
    }

    public function bank_accounts()
    {
        return $this->hasMany(HouseOwnerBankAccount::class);
    }

    public function images()
    {
        return $this->hasMany(HouseImage::class)->orderBy('image_index', 'asc');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function docs()
    {
        return $this->hasMany(HouseDoc::class);
    }

    public function agreements()
    {
        return $this->hasMany(HouseAgreement::class);
    }

    public function media()
    {
        return $this->hasMany(HouseMedia::class)->orderBy('image_index', 'asc');;
    }

    public function tenant()
    {
        return $this->hasMany(HouseTenant::class);
    }

    public function utility()
    {
        return $this->hasMany(HouseUtility::class);
    }

    public function tax()
    {
        return $this->hasMany(HouseTax::class);
    }

    public function cost()
    {
        return $this->hasMany(HouseCost::class);
    }

    public function invoice()
    {
        return $this->hasMany(HouseInvoice::class);
    }

    public function invoiceImage()
    {
        return $this->hasMany(InvoiceImage::class);
    }

    public function receipt()
    {
        return $this->hasMany(HouseReceipt::class);
    }
}