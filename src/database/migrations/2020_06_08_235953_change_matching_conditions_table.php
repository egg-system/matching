<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMatchingConditionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // area_idをnullableに
        Schema::table('matching_conditions', function (Blueprint $table): void {
            $table->unsignedBigInteger('area_id')->nullable()->comment('場所／エリア')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matching_conditions', function (Blueprint $table): void {
            $table->unsignedBigInteger('area_id')->nullable(false)->comment('場所／エリア')->change();
        });
    }
}
