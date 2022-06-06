<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superadmins', function (Blueprint $table) {
            $table->bigInteger('nip')->primary();
            $table->string('name');
            $table->string('fk_user');
            $table->timestamps();
        });

        Schema::table('superadmins', function (Blueprint $table) {
            $table->foreign('fk_user', 'fk_user_superadmins_fk_01')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superadmins');
    }
}
