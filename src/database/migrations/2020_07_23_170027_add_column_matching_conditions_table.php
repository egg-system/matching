<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMatchingConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->unsignedBigInteger('preferred_area_id')->nullable()->comment('希望エリア');
            $table->boolean('is_available_holiday')->default(false)->comment('休日勤務可能');
            $table->boolean('is_available_weekday')->default(false)->comment('平日勤務可能');
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
            $table->dropColumn('preferred_area_id');
            $table->dropColumn('is_available_holiday');
            $table->dropColumn('is_available_weekday');
        });
    }
}
