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
            $table->boolean('trainer_send_mail')->nullable()->after('name')->comment('トレーナーへのメール送信フラグ');
            $table->boolean('gym_send_mail')->nullable()->after('trainer_send_mail')->comment('ジムへのメール送信フラグ');
            $table->string('transition_state')->nullable()->after('gym_send_mail')->comment('遷移可能状態');
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
            $table->dropColumn('gym_send_mail');
        });
        Schema::table('offer_states', function (Blueprint $table) {
            $table->dropColumn('trainer_send_mail');
        });
        Schema::table('offer_states', function (Blueprint $table) {
            $table->dropColumn('transition_state');
        });
        Schema::table('offer_states', function (Blueprint $table) {
            $table->dropColumn('transition_user_type');
        });
    }
}
