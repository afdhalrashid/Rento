<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTenantPaymentAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_tenant_payment_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
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
        Schema::dropIfExists('invoice_tenant_payment_attachments');
    }
}