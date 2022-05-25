<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_media', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id');
            $table->integer('image_index');
            $table->string('name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_for')->nullable();
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
        Schema::dropIfExists('house_media');
    }
}
