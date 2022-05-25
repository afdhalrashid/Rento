<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_tenants', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id');
            $table->integer('tenant_user_id');
            $table->string('tenant_name');
            $table->string('tenant_ic');
            $table->string('tenant_as_in_ic_address1')->nullable();
            $table->string('tenant_as_in_ic_address2')->nullable();
            $table->string('tenant_as_in_ic_poskod')->nullable();
            $table->string('tenant_as_in_ic_daerah')->nullable();
            $table->string('tenant_as_in_ic_negeri')->nullable();
            $table->string('tenant_salinan_ic_path')->nullable();
            $table->string('tenant_gender')->nullable();
            $table->string('tenant_religion')->nullable();
            $table->string('tenant_race')->nullable();
            $table->string('tenant_is_married')->nullable();
            $table->string('tenant_is_work')->nullable();
            $table->string('tenant_phone_no')->nullable();
            $table->string('tenant_email')->nullable();

            // $table->string('tenant_vehicles_')->nullable();
            // $table->string('tenant_vehicle_type_with_name')->nullable();
            $table->string('tenant_company_name')->nullable();
            $table->string('tenant_company_phone')->nullable();
            $table->string('tenant_company_address1')->nullable();
            $table->string('tenant_company_address2')->nullable();
            $table->string('tenant_company_poskod')->nullable();
            $table->string('tenant_company_daerah')->nullable();
            $table->string('tenant_company_negeri')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_tenants');
    }
}
