<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialesMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMascota')->unsigned();
            $table->timestamps();

            $table->foreign('idMascota')->references('id')->on('mascotas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historiales_medicos');
    }
}
