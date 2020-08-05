<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign('offers_offer_from_id_foreign');
                $table->dropForeign('offers_offer_to_id_foreign');
            }
            $table->dropColumn([
                'offer_from_id',
                'offer_to_id'
            ]);

            $table->unsignedBigInteger('gym_login_id')->nullable()->after('id')->comment('ジム側のログインID');
            $table->unsignedBigInteger('trainer_login_id')->nullable()->after('gym_login_id')->comment('トレーナー側のログインID');
            $table->foreign('gym_login_id')->references('id')->on('login');
            $table->foreign('trainer_login_id')->references('id')->on('login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign('offers_gym_login_id_foreign');
                $table->dropForeign('offers_trainer_login_id_foreign');
            }
            $table->dropColumn([
                'trainer_login_id',
                'gym_login_id'
            ]);

            $table->unsignedBigInteger('offer_from_id')->after('id')->comment('オファーしたユーザーのID');
            $table->unsignedBigInteger('offer_to_id')->after('offer_from_id')->comment('オファーされたユーザーのID');
            $table->foreign('offer_from_id')->references('id')->on('login');
            $table->foreign('offer_to_id')->references('id')->on('login');
        });
    }
}
