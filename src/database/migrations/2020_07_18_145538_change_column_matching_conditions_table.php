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
        Schema::table('matching_conditions', function (Blueprint $table) {
            // 不要なカラム削除
            $table->dropColumn('occupation_id');
            $table->dropColumn('price');
            $table->dropColumn('work_time');

            // カラム追加
            $table->unsignedBigInteger("worktime_week")->nullable()->comment('勤務時間 - 1週間あたり');
            $table->boolean("holiday_work")->nullable()->comment('休日勤務可能');
            $table->boolean("weekday_work")->nullable()->comment('平日勤務可能');
            $table->boolean("adjust")->nullable()->comment('企業や案件に合わせて調整したい');
            $table->boolean("changing_jobs")->nullable()->comment('転職も検討している');

            // インデックス設定
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
        Schema::table('matching_conditions', function (Blueprint $table) {
            // カラム追加
            $table->unsignedBigInteger('occupation_id')->default(null)->comment('種類（パーソナル、ボクシング、フィットネス、etc）');
            $table->jsonb('price')->nullable()->comment('支払い単価');
            $table->jsonb('work_time')->nullable()->comment('募集する曜日や時間帯');

            // カラム削除
            $table->dropColumn('worktime_week');
            $table->dropColumn('holiday_work');
            $table->dropColumn('weekday_work');
            $table->dropColumn('adjust');
            $table->dropColumn('changing_jobs');

            // インデックス削除
            $table->dropIndex(['worktime_week', 'area_id']);
        });
    }
}
