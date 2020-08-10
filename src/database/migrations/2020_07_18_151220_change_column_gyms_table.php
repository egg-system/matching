<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 不要なカラム削除
        Schema::table('gyms', function (Blueprint $table) {
            $table->dropColumn(['president_name', 'staff_count', 'customer_count', 'requirements']);
        });

        // カラム追加
        Schema::table('gyms', function (Blueprint $table) {
            $table->json('profiles')->nullable()->comment('基本情報（代表者名、従業員数、住所-市区町村、住所-丁・番地以下）');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->unsignedBigInteger("prefecture_id")->nullable()->comment('住所 - 都道府県');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->text("gym_url")->nullable()->comment('店舗URL');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->text("description")->nullable()->comment('紹介文');
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
        Schema::table('gyms', function (Blueprint $table) {
            $table->string('president_name')->comment('代表者氏名');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->unsignedInteger('staff_count')->comment('スタッフ数');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->unsignedInteger('customer_count')->nullable()->comment('顧客数');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->json('requirements')->nullable()->comment('募集要項（人数、スキルなど）');
        });

        // カラム削除
        Schema::table('gyms', function (Blueprint $table) {            
            $table->dropColumn(['profiles', 'prefecture_id', 'gym_url', 'description']);
        });
    }
}