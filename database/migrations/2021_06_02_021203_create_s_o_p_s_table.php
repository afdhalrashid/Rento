<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSOPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_o_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('sop_name')->nullable();
            $table->string('file_name');
            // $table->string('sop_type');
            $table->string('file_path')->nullable();
            $table->string('file_for')->nullable();
            $table->string('remark');
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
        Schema::dropIfExists('s_o_p_s');
    }
}
