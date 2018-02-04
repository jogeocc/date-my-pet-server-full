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
            $table->integer('idMascota')->unsigned();
            $table->string("vaNombre",100);
            $table->date("vaFecha");
            $table->text("vaNota")->nullable();
            $table->timestamps();

            $table->foreign('idMascota')->references('id')->on('mascotas')->onDelete("cascade");

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacunas');
    }
}
