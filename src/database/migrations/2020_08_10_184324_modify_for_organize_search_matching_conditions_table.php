<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForOrganizeSearchMatchingConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カラム追加
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("can_adjust_to_trainer")->nullable()->comment('トレーナーに合わせて調整可');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 不要なカラム削除
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('can_adjust_to_trainer');
        });
    }
}
