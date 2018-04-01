<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVacunasAndDeleteVacMasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacuna_mascota', function (Blueprint $table) {
          $table->dropIndex('vacunas_idusuario_foreign');
        });

        Schema::dropIfExists('vacuna_mascota');

        Schema::table('vacunas', function (Blueprint $table) {
           $table->dropColumn('idUsuario');
           $table->integer('idMascotas')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacunas', function (Blueprint $table) {
            //
        });
    }
}
