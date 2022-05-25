<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseUtilityInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_utility_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id');
            $table->string('utility_name');
            $table->string('account_no')->nullable();
            $table->string('user_account_id')->nullable();
            $table->string('user_account_password')->nullable();
            $table->string('biller_code')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('house_utility_infos');
    }
}
