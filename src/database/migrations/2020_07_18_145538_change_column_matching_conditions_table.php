<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnMatchingConditionsTable extends Migration
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
            $table->dropColumn('occupation_id');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('price');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('work_time');
        });

        // カラム追加
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->unsignedBigInteger("weekly_worktime")->nullable()->comment('勤務時間 - 1週間あたり');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("can_work_holiday")->nullable()->comment('休日勤務可能');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("can_work_weekday")->nullable()->comment('平日勤務可能');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("hope_adjust_worktime")->nullable()->comment('企業や案件に合わせて調整したい');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("is_considering_change_job")->nullable()->comment('転職も検討している');
        });

        // インデックス設定
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->index(['weekly_worktime']);
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
            $table->unsignedBigInteger('occupation_id')->default(null)->comment('種類（パーソナル、ボクシング、フィットネス、etc）');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->jsonb('price')->nullable()->comment('支払い単価');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->jsonb('work_time')->nullable()->comment('募集する曜日や時間帯');
        });

        // カラム削除
        Schema::table('matching_conditions', function (Blueprint $table) {            
            $table->dropColumn('weekly_worktime');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('can_work_holiday');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('can_work_weekday');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('hope_adjust_worktime');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('is_considering_change_job');
        });

        // インデックス削除
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropIndex(['weekly_worktime']);
        });
    }
}
