<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_curso',
        'descricao',
        'valor',
        'data_inicio_inscricoes',
        'data_termino_inscricoes',
        'quantidade_maxima_inscritos',
        'arquivo_material',
    ];
}
