<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigInteger('nip')->primary();
            $table->string('name');
            $table->string('fk_user');
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->foreign('fk_user', 'fk_user_admins_fk_01')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
