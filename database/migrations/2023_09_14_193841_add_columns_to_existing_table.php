<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::table('virtues', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->integer('count')->nullable();
            $table->bigInteger('timeinterval')->nullable();
            $table->boolean('harmful')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('virtues', function (Blueprint $table) {
            $table->dropColumn(['name', 'count', 'timeinterval']);
        });
    }
};
