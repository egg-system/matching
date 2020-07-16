<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToMatchingConditionsTable extends Migration
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
            $table->dropColumn('price');
            $table->dropColumn('work_time');
        
            // カラム追加
            $table->unsignedBigInteger("worktime_week")->nullable()->comment('勤務時間 - 1週間あたり');
            $table->unsignedBigInteger("holiday_work")->nullable()->comment('休日勤務可能');
            $table->unsignedBigInteger("weekday_work")->nullable()->comment('平日勤務可能');
            $table->unsignedBigInteger("adjust")->nullable()->comment('企業や案件に合わせて調整したい');
            $table->unsignedBigInteger("changing_jobs")->nullable()->comment('転職も検討している');
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
            $table->jsonb('price')->nullable()->comment('支払い単価');
            $table->jsonb('work_time')->nullable()->comment('募集する曜日や時間帯');
        
            // カラム削除
            $table->dropColumn("worktime_week");
            $table->dropColumn("holiday_work");
            $table->dropColumn("weekday_work");
            $table->dropColumn("adjust");
            $table->dropColumn("changing_jobs");
        });
    }
}
