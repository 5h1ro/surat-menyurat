<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->integer('nisn')->primary();
            $table->string('name');
            $table->string('birthplace');
            $table->date('birthday');
            $table->string('class');
            $table->string('gender');
            $table->string('religion');
            $table->string('parent');
            $table->string('parent_job');
            $table->text('address');
            $table->integer('ni')->unique();
            $table->string('fk_user');
            $table->timestamps();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('fk_user', 'fk_user_students_fk_01')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
