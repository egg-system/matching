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
        // 不要なカラム削除
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn(['hope_adjust_worktime', 'is_considering_change_job']);
        });

        // カラム追加
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("can_adjust")->nullable()->comment('先方に合わせて調整可');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // カラム追加
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("hope_adjust_worktime")->nullable()->comment('企業や案件に合わせて調整したい');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("is_considering_change_job")->nullable()->comment('転職も検討している');
        });

        // 不要なカラム削除
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('can_adjust');
        });
    }
}
