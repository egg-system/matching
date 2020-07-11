<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToGymsTable extends Migration
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
            $table->dropColumn('customer_count');
            $table->dropColumn('requirements');

            // カラム追加
            $table->unsignedBigInteger("prefecture_id")->nullable()->comment('住所 - 都道府県');
            $table->string("cities")->nullable()->comment('住所 - 市区町村');
            $table->text("street_address")->nullable()->comment('住所 - 丁・番地以下');
            $table->text("gym_url")->nullable()->comment('店舗URL');
            $table->text("comment")->nullable()->comment('紹介文');
            $table->string("charge")->nullable()->comment('担当業務');
            $table->unsignedBigInteger("requirements_number")->nullable()->comment('募集人数');
            $table->json('pay')->nullable()->comment('希望時給');
            $table->unsignedBigInteger("experience")->nullable()->comment('経験年数');
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
            $table->unsignedInteger('customer_count')->nullable()->comment('顧客数');
            $table->json('requirements')->nullable()->comment('募集要項（人数、スキルなど）');

            // カラム削除
            $table->dropColumn('prefecture_id');
            $table->dropColumn('cities');
            $table->dropColumn('street_address');
            $table->dropColumn('gym_url');
            $table->dropColumn('comment');
            $table->dropColumn('charge');
            $table->dropColumn('requirements_number');
            $table->dropColumn('pay');
            $table->dropColumn('experience');
        });
    }
}
