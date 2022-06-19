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
            $table->string('id')->primary();
            $table->string('number',25);
            $table->string('to',30);
            $table->text('detail',150);
            $table->text('letter');
            $table->string('fk_type');
            $table->integer('fk_student');
            $table->integer('status')->default(0);
            $table->timestamps();
        });


        Schema::table('fixings', function (Blueprint $table) {
            $table->foreign('fk_type', 'fk_type_fixings_fk_01')->references('id')->on('fixing_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_student', 'fk_student_fixings_fk_03')->references('nisn')->on('students')->onUpdate('cascade')->onDelete('cascade');
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
