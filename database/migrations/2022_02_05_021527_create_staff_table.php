<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('nip')->unique();
            $table->string('rank');
            $table->string('class');
            $table->integer('id_user')->unsigned();
            $table->integer('id_type')->unsigned()->default('1');
            $table->timestamps();
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('id_user', 'id_user_staff_fk_01')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_type', 'id_type_staff_fk_01')->references('id')->on('staff_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
