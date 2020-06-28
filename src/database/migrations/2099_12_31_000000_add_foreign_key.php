<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * 外部キー制約の設定追加の一元管理を行う.
     */
    public function up(): void
    {
        // matcing_conditions
        Schema::table('matching_conditions', function (Blueprint $table): void {
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('area_id')->references('id')->on('areas');
        });
        Schema::table('offers', function (Blueprint $table): void {
            $table->foreign('offer_from_id')->references('id')->on('login');
            $table->foreign('offer_to_id')->references('id')->on('login');
            $table->foreign('offer_state')->references('id')->on('offer_states');
        });
    }

    /**
     * 外部キー制約の設定削除の一元管理を行う.
     */
    public function down(): void
    {
        // matcing_conditions
        Schema::table('matching_conditions', function (Blueprint $table): void {
            $table->dropForeign('occupations_occupation_id_foreign');
            $table->dropForeign('areas_area_id_foreign');
        });
        Schema::table('offers', function (Blueprint $table): void {
            $table->dropForeign('offers_offer_from_id_foreign');
            $table->dropForeign('offers_offer_to_id_foreign');
            $table->dropForeign('offers_offer_state_foreign');
        });
    }
}
