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
        // area_idをnullableに
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id')->nullable()->comment('場所／エリア')->change();
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
            $table->unsignedBigInteger('area_id')->nullable(false)->comment('場所／エリア')->change();
        });
    }
}
