<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('house_id');
            $table->integer('tenant_id');
            $table->string('invoice_number');
            $table->string('invoice_name');
            $table->string('invoice_save_path');
            $table->date('invoice_date');
            $table->date('invoice_due_date');
            $table->integer('bank_account_id');
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
        Schema::dropIfExists('house_invoices');
    }
}