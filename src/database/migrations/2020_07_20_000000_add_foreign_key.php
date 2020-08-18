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
        // matcing_conditions
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas');
        });
        // offers
        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('offer_from_id')->references('id')->on('login');
            $table->foreign('offer_to_id')->references('id')->on('login');
            $table->foreign('offer_state')->references('id')->on('offer_states');
        });
        // user_occupations
        Schema::table('user_occupations', function (Blueprint $table) {
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('user_id')->references('id')->on('matching_conditions');
        });
        // gyms
        Schema::table('gyms', function (Blueprint $table) {
            $table->foreign('prefecture_id')->references('id')->on('prefectures');
        });
        // jobs
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('gym_id')->references('id')->on('gyms');
        });
    }

    /**
     * 外部キー制約の設定削除の一元管理を行う
     *
     * @return void
     */
    public function down()
    {
        // matcing_conditions
        Schema::table('matching_conditions', function (Blueprint $table) {
            $table->dropForeign('matching_conditions_area_id_foreign');
        });
        // offers
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_offer_from_id_foreign');
            $table->dropForeign('offers_offer_to_id_foreign');
            $table->dropForeign('offers_offer_state_foreign');
        });
        // user_occupations
        Schema::table('user_occupations', function (Blueprint $table) {
            $table->dropForeign('user_occupations_occupation_id_foreign');
            $table->dropForeign('user_occupations_user_id_foreign');
        });
        // gyms
        Schema::table('gyms', function (Blueprint $table) {
            $table->dropForeign('gyms_prefecture_id_foreign');
        });
        // jobs
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign('jobs_gym_id_foreign');
        });
    }
}
