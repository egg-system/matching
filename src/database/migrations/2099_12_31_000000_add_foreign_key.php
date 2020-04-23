<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * 外部キー制約の設定追加の一元管理を行う
     *
     * @return void
     */
    public function up()
    {
        // ジムオーナー
        Schema::table('gyms', function (Blueprint $table) {
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('area_id')->references('id')->on('areas');
        });

        // トレーナー
        Schema::table('trainers', function (Blueprint $table) {
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('area_id')->references('id')->on('areas');
        });
    }

    /**
     * 外部キー制約の設定削除の一元管理を行う
     *
     * @return void
     */
    public function down()
    {
        // ジムオーナー
        Schema::table('gyms', function (Blueprint $table) {
            $table->dropForeign('occupations_occupation_id_foreign');
            $table->dropForeign('areas_area_id_foreign');
            $table->timestamps();
        });

        // トレーナー
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropForeign('occupations_occupation_id_foreign');
            $table->dropForeign('areas_area_id_foreign');
        });
    }
}
