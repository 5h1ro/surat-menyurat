<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->string('number')->primary();
            $table->string('title',50);
            $table->string('letter_number',70);
            $table->date('letter_date');
            $table->string('from',50);
            $table->text('detail',200);
            $table->text('letter');
            $table->string('fk_type');
            $table->bigInteger('fk_admin');
            $table->bigInteger('fk_headmaster')->nullable();
            $table->integer('status')->default(0);
            $table->integer('status_teacher')->default(0);
            $table->timestamps();
        });
        Schema::table('incomings', function (Blueprint $table) {
            $table->foreign('fk_type', 'fk_type_incomings_fk_01')->references('id')->on('incoming_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_admin', 'fk_admin_incomings_fk_02')->references('nip')->on('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_headmaster', 'fk_headmaster_incomings_fk_04')->references('nip')->on('headmasters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomings');
    }
}
