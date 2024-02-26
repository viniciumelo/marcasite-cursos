<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoUsuario;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define os valores para os tipos de usuário
        $tiposUsuarios = [
            ['tipo' => 'Admin'],
            ['tipo' => 'Aluno'],
            ['tipo' => 'Professor'],
            ['tipo' => 'Outros'],
        ];

        // Insere os valores na tabela tipo_usuario
        TipoUsuario::insert($tiposUsuarios);
    }
}
