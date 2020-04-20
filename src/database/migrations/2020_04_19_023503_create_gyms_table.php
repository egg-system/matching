<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ジムオーナー
        Schema::create('gyms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('屋号、事業名');
            $table->string('president_name')->comment('代表者氏名');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->unsignedBigInteger('occupation_id')->comment('種類（パーソナル、ボクシング、フィットネス、etc）');
            $table->unsignedBigInteger('area_id')->comment('場所／エリア');
            $table->unsignedInteger('staff_count')->comment('スタッフ数');
            $table->unsignedInteger('customer_count')->nullable()->comment('顧客数');
            $table->json('requirements')->nullable()->comment('募集要項（人数、スキルなど）');
            $table->json('price')->nullable()->comment('支払い単価');
            $table->json('work_time')->nullable()->comment('募集する曜日や時間帯');
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
        Schema::dropIfExists('gyms');
    }
}
