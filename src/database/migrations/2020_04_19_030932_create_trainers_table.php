<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('氏名');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->unsignedBigInteger('occupation_id')->comment('種類（パーソナル、ボクシング、フィットネス、etc）');
            $table->unsignedBigInteger('area_id')->comment('場所／エリア');
            $table->text('pr_comment')->nullable()->comment('PRのコメント');
            $table->jsonb('hope_price')->nullable()->comment('支払い単価');
            $table->jsonb('hope_work_time')->nullable()->comment('募集する曜日や時間帯');
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
        Schema::dropIfExists('trainers');
    }
}
