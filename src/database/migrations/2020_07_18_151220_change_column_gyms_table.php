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
        Schema::table('gyms', function (Blueprint $table) {
            // 不要なカラム削除
            $table->dropColumn('president_name');
            $table->dropColumn('staff_count');
            $table->dropColumn('customer_count');
            $table->dropColumn('requirements');

            // カラム追加
            $table->json('basic_profile')->nullable()->comment('基本情報（代表者名、従業員数、住所-市区町村、住所-丁・番地以下）');
            $table->unsignedBigInteger("prefecture_id")->nullable()->comment('住所 - 都道府県');
            $table->text("gym_url")->nullable()->comment('店舗URL');
            $table->text("comment")->nullable()->comment('紹介文');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gyms', function (Blueprint $table) {
            // カラム追加
            $table->string('president_name')->comment('代表者氏名');
            $table->unsignedInteger('staff_count')->comment('スタッフ数');
            $table->unsignedInteger('customer_count')->nullable()->comment('顧客数');
            $table->json('requirements')->nullable()->comment('募集要項（人数、スキルなど）');

            // カラム削除
            $table->dropColumn('basic_profile');
            $table->dropColumn('prefecture_id');
            $table->dropColumn('gym_url');
            $table->dropColumn('comment');
        });
    }
}
