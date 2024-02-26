<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_curso');
            $table->text('descricao');
            $table->decimal('valor', 8, 2);
            $table->dateTime('data_inicio_inscricoes');
            $table->dateTime('data_termino_inscricoes');
            $table->unsignedInteger('quantidade_maxima_inscritos');
            $table->string('arquivo_material')->nullable();
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
        Schema::dropIfExists('cursos');
    }
};
