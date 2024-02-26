<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersFromView;
use Barryvdh\DomPDF\Facade as PDF;

class AlunoController extends Controller
{
    /**
     * Exibe uma lista de todos os alunos cadastrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', compact('alunos'));
    }

    /**
     * Exibe o formulário para criação de um novo aluno.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('alunos.create', compact('cursos'));
    }

    /**
     * Armazena um novo aluno no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|string|unique:alunos,cpf',
            'endereco' => 'required|string',
            'empresa' => 'required|string',
            'telefone' => 'required|string',
            'celular' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            // Criar um novo usuário
            $user = new User();
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->tipo_usuario_id = 2; // ID do tipo de usuário "Aluno"
            $user->save();

            // Criar um novo aluno associado ao usuário
            $aluno = new Aluno();
            $aluno->cpf = $request->cpf;
            $aluno->endereco = $request->endereco;
            $aluno->empresa = $request->empresa;
            $aluno->telefone = $request->telefone;
            $aluno->celular = $request->celular;
            $aluno->curso_id = $request->curso_id;
            $aluno->user_id = $user->id; // Associa o aluno ao usuário criado
            $aluno->save();

            DB::commit();
            return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao cadastrar o aluno. Por favor, tente novamente.');
        }
    }

    /**
     * Exibe o formulário para editar um aluno específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        $cursos = Curso::all(); // Você precisa passar os cursos para a view
        return view('alunos.edit', compact('aluno', 'cursos'));
    }

    /**
     * Atualiza os dados de um aluno específico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'cpf' => 'required|string|unique:alunos,cpf,' . $id,
            'endereco' => 'required|string',
            'empresa' => 'required|string',
            'telefone' => 'required|string',
            'celular' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            // Encontrar o aluno pelo ID
            $aluno = Aluno::findOrFail($id);

            // Atualizar os dados do usuário associado ao aluno, se necessário
            $user = $aluno->user;
            $user->name = $request->nome;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            // Atualizar os dados do aluno
            $aluno->cpf = $request->cpf;
            $aluno->endereco = $request->endereco;
            $aluno->empresa = $request->empresa;
            $aluno->telefone = $request->telefone;
            $aluno->celular = $request->celular;
            $aluno->curso_id = $request->curso_id;
            $aluno->save();

            DB::commit();
            return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao atualizar o aluno. Por favor, tente novamente.');
        }
    }

    /**
     * Remove um aluno específico do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $aluno = Aluno::findOrFail($id);
            $aluno->delete();

            DB::commit();
            return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao excluir o aluno. Por favor, tente novamente.');
        }
    }

    public function exportExcel()
    {
        return Excel::download(new CustomersFromView, 'alunos.xlsx');
    }

    public function exportPDF()
    {
        return Excel::download(new CustomersFromView, 'alunos.pdf');
    }
}
