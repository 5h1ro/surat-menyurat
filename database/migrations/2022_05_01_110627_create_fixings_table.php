<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('to');
            $table->text('detail');
            $table->text('letter');
            $table->integer('id_type')->unsigned();
            $table->integer('id_student')->unsigned();
            $table->integer('status')->default(0);
            $table->timestamps();
        });


        Schema::table('fixings', function (Blueprint $table) {
            $table->foreign('id_type', 'id_student_fixings_fk_01')->references('id')->on('fixing_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_student', 'id_student_fixings_fk_03')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixings');
    }
}
