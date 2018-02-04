<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUsuario')->unsigned();
            $table->string('masNombre',100);
            $table->string('masRaza',100);
            $table->enum('masTipo',['Perro','Gato','Ave','otros']);
            $table->enum('masSexo',['M','H']);
            $table->smallInteger('masEdad');
            $table->text('masSenaPart');
            $table->string('masFoto')->default('mascotas/sinfoto.png');
            $table->text('masHobbie')->nullable();
            $table->boolean("masCompPerf")->default(0);
            $table->boolean("masActivo")->default(1);
            $table->timestamps();

            $table->foreign('idUsuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
