<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 不要なカラム削除
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['bussiness_description', 'pay_min', 'pay_max', 'experience_years']);
        });

        // カラム追加
        Schema::table('jobs', function (Blueprint $table) {
            $table->json('job_content')->nullable()->comment('求人詳細内容（タイトル、詳細見出し、詳細画像、詳細文章、求める人物像）');
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
        Schema::table('jobs', function (Blueprint $table) {
            $table->text('bussiness_description')->nullable()->comment('担当業務');
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('pay_min')->nullable()->comment('最低希望時給');
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('pay_max')->nullable()->comment('最高希望時給');
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('experience_years')->nullable()->comment('経験年数');
        });

        // 不要なカラム削除
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('job_content');
        });
    }
}
