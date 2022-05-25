<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone_no')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->date('date_subscribe')->nullable();
                $table->integer('period_before_end_subscribe')->nullable();
                $table->date('date_expired')->nullable();
                // $table->foreignId('role_id')->nullable()->constrained('role');
                // $table->integer('role_id');
                $table->integer('created_by');
                $table->integer('status');
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}