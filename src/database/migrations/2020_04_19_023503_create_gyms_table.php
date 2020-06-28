<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ジムオーナー
        Schema::create('gyms', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->nullable()->comment('屋号、事業名');
            $table->string('president_name')->comment('代表者氏名');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->unsignedInteger('staff_count')->comment('スタッフ数');
            $table->unsignedInteger('customer_count')->nullable()->comment('顧客数');
            $table->json('requirements')->nullable()->comment('募集要項（人数、スキルなど）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
}
