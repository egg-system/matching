<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGymsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ジムオーナーのスタッフ数をnullableに変更
        Schema::table('gyms', function (Blueprint $table): void {
            $table->unsignedInteger('staff_count')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gyms', function (Blueprint $table): void {
        });
    }
}
