<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_from_id')->comment('オファーしたユーザーのID');
            $table->unsignedBigInteger('offer_to_id')->comment('オファーされたユーザーのID');
            $table->unsignedBigInteger('offer_state')->comment('オファーの状況');
            $table->text('message')->comment('オファーの内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
