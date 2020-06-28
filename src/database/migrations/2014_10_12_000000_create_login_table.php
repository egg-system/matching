<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['email', 'user_type']);
            $table->index(['user_type', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
