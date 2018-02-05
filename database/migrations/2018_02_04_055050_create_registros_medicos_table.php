<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('veterinarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUsuario')->unsigned();
            $table->string('vetNombre',180);
            $table->text('vetDireccion')->nullable();
            $table->string('vetTelefono',20);
            $table->string('vetNomVeterinaria',180);
            $table->timestamps();

            $table->foreign('idUsuario')->references('id')->on('users')->onDelete("cascade");
            
        });

        Schema::create('registros_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idHistorial')->unsigned();
            $table->integer('idVeterinario')->unsigned();
            $table->date('regMedFecha');
            $table->string('regMedPercanse',80);
            $table->text('regMedDescp')->nullable();
            $table->timestamps();

            $table->foreign('idHistorial')->references('id')->on('historiales_medicos')->onDelete("cascade");
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
        Schema::dropIfExists('veterinarios');
        Schema::dropIfExists('registros_medicos');
    }
}
