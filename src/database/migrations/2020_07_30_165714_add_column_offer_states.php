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
            $table->boolean('trainer_send_mail')->after('name')->comment('トレーナーへのメール送信フラグ');
            $table->boolean('gym_send_mail')->after('trainer_send_mail')->comment('ジムへのメール送信フラグ');
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
            $table->dropColumn('trainer_send_mail');
        });
    }
}
