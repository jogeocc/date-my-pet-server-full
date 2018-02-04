<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMascotasVeterianriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascota_veterinario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMascota')->unsigned();
            $table->integer('idVeterinario')->unsigned();
            $table->timestamps();

            $table->foreign('idMascota')->references('id')->on('mascotas')->onDelete("cascade");

            $table->foreign('idVeterinario')->references('id')->on('veterinarios')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascota_veterinario');
    }
}
