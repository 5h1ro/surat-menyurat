<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_incoming')->unsigned();
            $table->integer('id_teacher')->unsigned()->nullable();
            $table->integer('id_staff')->unsigned()->nullable();
            $table->text('letter')->nullable();
            $table->integer('status')->default(0);
            $table->integer('information')->default(2);
            $table->string('instruction')->nullable();
            $table->timestamps();
        });
        Schema::table('dispositions', function (Blueprint $table) {
            $table->foreign('id_incoming', 'id_incoming_dispositions_fk_01')->references('id')->on('incomings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_teacher', 'id_teacher_dispositions_fk_02')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_staff', 'id_staff_dispositions_fk_03')->references('id')->on('staff')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositions');
    }
}
