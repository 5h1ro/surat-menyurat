<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutgoingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('to');
            $table->text('detail');
            $table->text('letter');
            $table->integer('id_type')->unsigned();
            $table->integer('id_teacher')->unsigned()->nullable();
            $table->integer('id_staff')->unsigned()->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('outgoings', function (Blueprint $table) {
            $table->foreign('id_type', 'id_type_outgoings_fk_01')->references('id')->on('outgoing_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_teacher', 'id_teacher_outgoings_fk_02')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_staff', 'id_staff_outgoings_fk_04')->references('id')->on('staff')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outgoings');
    }
}
