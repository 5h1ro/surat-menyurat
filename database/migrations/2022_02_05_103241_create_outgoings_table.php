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
            $table->string('id')->primary();
            $table->string('number');
            $table->string('to');
            $table->text('detail');
            $table->text('letter');
            $table->string('fk_type');
            $table->bigInteger('fk_teacher')->nullable();
            $table->bigInteger('fk_staff')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('outgoings', function (Blueprint $table) {
            $table->foreign('fk_type', 'fk_type_outgoings_fk_01')->references('id')->on('outgoing_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_teacher', 'fk_teacher_outgoings_fk_02')->references('nip')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_staff', 'fk_staff_outgoings_fk_04')->references('nip')->on('staff')->onUpdate('cascade')->onDelete('cascade');
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
