<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id');
            $table->integer('invoice_id');
            $table->string('receipt_number');
            $table->string('receipt_name');
            $table->string('receipt_save_path');
            $table->date('receipt_date');
            $table->date('receipt_due_date');
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
        Schema::dropIfExists('house_receipts');
    }
}