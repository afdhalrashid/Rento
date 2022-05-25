<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'house_utilities',
            function (Blueprint $table) {
                $table->id();
                $table->integer('house_id');
                $table->string('utility_type');
                $table->integer('year');
                $table->integer('month');
                $table->string('value');
                $table->string('image_name')->nullable();
                $table->string('image_path')->nullable();
                $table->string('remark')->nullable();
                $table->date('payment_date')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_utilities');
    }
}
