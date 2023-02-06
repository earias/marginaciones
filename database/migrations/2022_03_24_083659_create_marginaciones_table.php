<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarginacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marginaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('libro');
            $table->string('partida');
            $table->string('folio');
            $table->Integer('annio');
            $table->string('tipo');
            $table->text('texto');
            $table->integer('libromarg');
            $table->string('marginacion');
            $table->string('habilitado');
            $table->text('textoh');
            $table->string('iniciales');
            $table->string ('jefe');
            $table->string ('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marginaciones');
    }
}
