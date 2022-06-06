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
            $table->string('id')->primary();
            $table->string('fk_incoming');
            $table->bigInteger('fk_teacher')->nullable();
            $table->bigInteger('fk_staff')->nullable();
            $table->text('letter')->nullable();
            $table->integer('status')->default(0);
            $table->integer('information')->default(2);
            $table->string('instruction')->nullable();
            $table->timestamps();
        });
        Schema::table('dispositions', function (Blueprint $table) {
            $table->foreign('fk_incoming', 'fk_incoming_dispositions_fk_01')->references('number')->on('incomings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_teacher', 'fk_teacher_dispositions_fk_02')->references('nip')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_staff', 'fk_staff_dispositions_fk_03')->references('nip')->on('staff')->onUpdate('cascade')->onDelete('cascade');
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
