<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainers', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->comment('氏名');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->text('pr_comment')->nullable()->comment('PRのコメント');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
}
