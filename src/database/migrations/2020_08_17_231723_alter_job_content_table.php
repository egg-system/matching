<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['job_content', 'requirements_number']);
        });

        // drop後でなければ、同名のカラムは追加できない
        Schema::table('jobs', function (Blueprint $table) {
            $table
                ->string('title')
                ->nullable(true)
                ->after('gym_id')
                ->comment('求人タイトル');
            $table
                ->string('main_image_url')
                ->nullable(true)
                ->after('title')
                ->comment('求人のメイン画像(URLが入る想定)');
            $table
                ->text('job_content')
                ->nullable(true)
                ->after('main_image_url')
                ->comment('業務内容');
            $table
                ->text('requirements')
                ->nullable()
                ->after('job_content')
                ->comment('募集要項');
            $table
                ->unsignedBigInteger('requirements_number')
                ->nullable()
                ->after('requirements')
                ->comment('募集人数');
            $table
                ->json('job_info')
                ->nullable()
                ->after('requirements_number')
                ->comment('その他の求人情報');
        });

        // sqliteの場合、not nullが追加できないため、後変更する
        Schema::table('jobs', function (Blueprint $table) {
            $table
                ->string('title')
                ->after('gym_id')
                ->nullable(false)
                ->comment('求人タイトル')
                ->change();
            $table
                ->string('main_image_url')
                ->after('title')
                ->nullable(false)
                ->comment('求人のメイン画像(URLが入る想定)')
                ->change();
            $table
                ->text('job_content')
                ->nullable(false)
                ->after('main_image_url')
                ->comment('業務内容')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'main_image_url',
                'job_content',
                'job_info',
                'requirements',
            ]);
        });

        // drop後でなければ、同名のカラムは追加できない
        Schema::table('jobs', function (Blueprint $table) {
            $table
                ->json('job_content')
                ->nullable()
                ->comment('求人詳細内容（タイトル、詳細見出し、詳細画像、詳細文章、求める人物像）');
            
        });
    }
}
