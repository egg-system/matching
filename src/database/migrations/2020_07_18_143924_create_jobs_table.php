<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 求人
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_id')->comment('ジムID');
            $table->text('bussiness_description')->nullable()->comment('担当業務');
            $table->unsignedBigInteger('requirements_number')->nullable()->comment('募集人数');
            $table->unsignedBigInteger('pay_min')->nullable()->comment('最低希望時給');
            $table->unsignedBigInteger('pay_max')->nullable()->comment('最高希望時給');
            $table->unsignedBigInteger('experience')->nullable()->comment('経験年数');
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
        Schema::dropIfExists('jobs');
    }
}
