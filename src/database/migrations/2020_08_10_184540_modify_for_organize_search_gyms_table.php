<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForOrganizeSearchGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // コメントの変更
        Schema::table('gyms', function (Blueprint $table) {
            $table->json('profiles')->nullable()->comment('基本情報（ジム名、代表者名、従業員数、住所-市区町村、住所-丁・番地以下）')->change();
        });

        // 不要なカラム削除
        Schema::table('gyms', function (Blueprint $table) {
            $table->dropColumn(['description', 'tel']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // コメントの変更
        Schema::table('gyms', function (Blueprint $table) {
            $table->json('profiles')->nullable()->comment('基本情報（代表者名、従業員数、住所-市区町村、住所-丁・番地以下）')->change();
        });

        // カラム追加
        Schema::table('gyms', function (Blueprint $table) {
            $table->text("description")->nullable()->comment('紹介文');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->string('tel')->nullable()->comment('電話番号');
        });
    }
}
