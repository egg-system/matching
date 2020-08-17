<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPhotoUrlToLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ジムの写真は求人ごとのため、ログインに紐付けるとおかしくなるため、drop
        Schema::table('login', function (Blueprint $table) {
            $table->dropColumn(['photo_url']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('login', function (Blueprint $table) {
            $table->text('photo_url')
                ->nullable()
                ->after('remember_token')
                ->comment('写真URL');
        });
    }
}
