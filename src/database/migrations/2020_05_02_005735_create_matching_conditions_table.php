<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchingConditionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matching_conditions', function (Blueprint $table): void {
            $table->id();
            $table->morphs('user');
            $table->unsignedBigInteger('occupation_id')->default(null)->comment('種類（パーソナル、ボクシング、フィットネス、etc）');
            $table->unsignedBigInteger('area_id')->default(null)->comment('場所／エリア');
            $table->jsonb('price')->nullable()->comment('支払い単価');
            $table->jsonb('work_time')->nullable()->comment('募集する曜日や時間帯');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matcing_conditons');
    }
}
