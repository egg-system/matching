<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterForeignKeyOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // テーブル名が変わると、外部キーも変わるので、先に削除する
        Schema::table('user_occupations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['occupation_id']);
        });
        Schema::rename('user_occupations', 'matching_condition_occupations');
        Schema::table('matching_condition_occupations', function (Blueprint $table) {
            $table->renameColumn('user_id', 'matching_condition_id');
            $table
                ->foreign('matching_condition_id')
                ->references('id')
                ->on('matching_conditions');
            $table
                ->foreign('occupation_id')
                ->references('id')
                ->on('occupations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // テーブル名が変わると、外部キーも変わるので、先に削除する
        Schema::table('matching_condition_occupations', function (Blueprint $table) {
            $table->dropForeign(['matching_condition_id']);
            $table->dropForeign(['occupation_id']);
        });
        Schema::rename('matching_condition_occupations', 'user_occupations');
        Schema::table('user_occupations', function (Blueprint $table) {
            $table->renameColumn('matching_condition_id', 'user_id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('matching_conditions');
            $table
                ->foreign('occupation_id')
                ->references('id')
                ->on('occupations');
        });
    }
}
