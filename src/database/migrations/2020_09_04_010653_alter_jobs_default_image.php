<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobsDefaultImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table
                ->string('main_image_url')
                ->nullable(false)
                ->default('/images/app/default-login-icon.png')
                ->after('title')
                ->comment('求人のメイン画像(URLが入る想定)')
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
            $table
                ->string('main_image_url')
                ->nullable(false)
                ->default(false)
                ->after('title')
                ->comment('求人のメイン画像(URLが入る想定)')
                ->change();
        });
    }
}
