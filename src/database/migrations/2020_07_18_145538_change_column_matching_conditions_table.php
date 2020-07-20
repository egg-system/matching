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
            $table->unsignedBigInteger("worktime_week")->nullable()->comment('勤務時間 - 1週間あたり');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("holiday_work")->nullable()->comment('休日勤務可能');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("weekday_work")->nullable()->comment('平日勤務可能');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("adjust")->nullable()->comment('企業や案件に合わせて調整したい');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->boolean("changing_jobs")->nullable()->comment('転職も検討している');
        });

        // インデックス設定
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->index(['worktime_week', 'area_id']);
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
            $table->dropColumn('worktime_week');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('holiday_work');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('weekday_work');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('adjust');
        });
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropColumn('changing_jobs');
        });

        // インデックス削除
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropIndex(['worktime_week', 'area_id']);
        });
    }
}
