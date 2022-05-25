<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todo_titles', function (Blueprint $table) {
            $table->integer('day_notify')->nullable()
            ->default(0)
            ->after('readTitle');
            $table->timestamp('dateline')->nullable()
            ->after('readTitle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todo_titles', function (Blueprint $table) {
            $table->dropColumn('day_notify');
            $table->dropColumn('dateline');
        });
    }
}
