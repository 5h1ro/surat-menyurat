<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadmastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headmasters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('nip')->unique();
            $table->string('rank');
            $table->string('class');
            $table->integer('id_user')->unsigned();
            $table->timestamps();
        });

        Schema::table('headmasters', function (Blueprint $table) {
            $table->foreign('id_user', 'id_user_headmasters_fk_01')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('headmasters');
    }
}
