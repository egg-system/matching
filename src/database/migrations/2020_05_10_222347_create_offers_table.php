<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table): void {
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
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
}
