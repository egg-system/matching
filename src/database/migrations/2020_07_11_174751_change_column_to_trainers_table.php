<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainers', function (Blueprint $table) {
            // カラム追加
            $table->unsignedBigInteger("now_work_area_id")->nullable()->comment('今の勤務エリア');
            $table->unsignedBigInteger("now_work_style")->nullable()->comment('今の働き方(1:ジム勤務、2:フリーランス)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainers', function (Blueprint $table) {
            // カラム削除
            $table->dropColumn('now_work_area_id');
            $table->dropColumn('now_work_style');
        });
    }
}
