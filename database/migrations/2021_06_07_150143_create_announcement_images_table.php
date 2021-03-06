<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_images', function (Blueprint $table) {
            $table->id();
            $table->integer('announcement_id');
            $table->integer('image_index');
            $table->string('image_name')->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_for')->nullable();
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
        Schema::dropIfExists('announcement_images');
    }
}
