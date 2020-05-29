<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMatchingConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->unsignedBigInteger('occupation_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->unsignedBigInteger('occupation_id')->nullable(false)->change();
        });
    }
}
