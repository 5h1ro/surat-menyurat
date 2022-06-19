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
            $table->bigInteger('nip')->primary();
            $table->string('name',100);
            $table->string('rank',21);
            $table->string('class',10);
            $table->string('fk_user');
            $table->string('fk_type')->default('ST-01');
            $table->timestamps();
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('fk_user', 'fk_user_staff_fk_01')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('fk_type', 'fk_type_staff_fk_01')->references('id')->on('staff_types')->onUpdate('cascade')->onDelete('cascade');
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
