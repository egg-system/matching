<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // カラム追加
        Schema::table('trainers', function (Blueprint $table) {
            $table->unsignedBigInteger("now_work_area_id")->nullable()->comment('今の勤務エリア');
        });
        Schema::table('trainers', function (Blueprint $table) {
            $table->unsignedBigInteger("now_work_style")->nullable()->comment('今の働き方(1:ジム勤務、2:フリーランス)');
        });
        Schema::table('trainers', function (Blueprint $table) {
            $table->json('carrer')->nullable()->comment('経歴');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // カラム削除
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('now_work_area_id');
        });
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('now_work_style');
        });
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('carrer');
        });
    }
}
