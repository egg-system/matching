<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOfferStates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_states', function (Blueprint $table) {
            $table->boolean('trainer_notice_flg')->nullable()->after('name')->comment('トレーナーへの通知フラグ');
            $table->boolean('gym_notice_flg')->nullable()->after('trainer_notice_flg')->comment('ジムへの通知フラグ');
            $table->string('transition_state')->nullable()->after('gym_notice_flg')->comment('遷移可能状態');
            $table->string('transition_user_type')->nullable()->after('transition_state')->comment('遷移可能なユーザー種別');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_states', function (Blueprint $table) {
            $table->dropColumn([
                'gym_send_mail',
                'trainer_send_mail',
                'transition_state',
                'transition_user_type'
            ]);
        });
    }
}
