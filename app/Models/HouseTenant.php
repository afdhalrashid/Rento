<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseTenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'tenant_user_id',
        'tenant_name',
        'tenant_ic',
        'tenant_as_in_ic_address1',
        'tenant_as_in_ic_address2',
        'tenant_as_in_ic_poskod',
        'tenant_as_in_ic_daerah',
        'tenant_as_in_ic_negeri',
        'tenant_race',
        'tenant_is_work',
        'tenant_is_married',
        'tenant_phone_no',
        'tenant_email',
        'tenant_company_name',
        'tenant_company_phone',
        'tenant_company_address1',
        'tenant_company_address2',
        'tenant_company_poskod',
        'tenant_company_daerah',
        'tenant_company_negeri',
        'created_by',

    ];

    protected $with = ['parameter_state', 'parameter_state_company','parameter_race', 'vehicles'];

    public function vehicles()
    {
        return $this->hasMany(HouseTenantVehicle::class, 'tenant_id', 'id');
    }

    public function parameter_state()
    {
        return $this->belongsTo('App\Models\Parameter', 'tenant_as_in_ic_negeri', 'type_id');
    }

    public function parameter_state_company()
    {
        return $this->belongsTo('App\Models\Parameter', 'tenant_company_negeri', 'type_id');
    }

    public function parameter_race()
    {
        return $this->belongsTo('App\Models\Parameter', 'tenant_race', 'type_id');
    }
}