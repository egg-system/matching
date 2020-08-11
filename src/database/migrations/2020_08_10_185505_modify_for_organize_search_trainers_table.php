<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForOrganizeSearchTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 不要なカラム削除
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn(['pr_comment', 'tel']);
        });

        // カラム追加
        Schema::table('trainers', function (Blueprint $table) {
            $table->string('display_name')->nullable()->comment('表示名');
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
        Schema::table('trainers', function (Blueprint $table) {
            $table->text('pr_comment')->nullable()->comment('PRのコメント');
        });
        Schema::table('trainers', function (Blueprint $table) {
            $table->string('tel')->nullable()->comment('電話番号');
        });

        // 不要なカラム削除
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('display_name');
        });
    }
}
