<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigInteger('nip')->primary();
            $table->string('name');
            $table->string('rank');
            $table->string('class');
            $table->string('fk_user');
            $table->timestamps();
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->foreign('fk_user', 'fk_user_teachers_fk_01')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
