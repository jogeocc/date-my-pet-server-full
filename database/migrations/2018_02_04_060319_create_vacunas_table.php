<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('vacunas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUsuario')->unsigned();
            $table->integer('idMascota')->unsigned();
            $table->string("vaNombre",100);
            $table->date("vaFecha");
            $table->text("vaNota")->nullable();
            $table->timestamps();

            $table->foreign('idMascota')->references('id')->on('mascotas')->onDelete("cascade");
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacuna_mascota');
        Schema::dropIfExists('vacunas');

    }
}
