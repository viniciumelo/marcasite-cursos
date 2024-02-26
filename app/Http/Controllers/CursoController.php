<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Exibe uma lista dos cursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Exibe o formulário para criação de um novo curso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Armazena um novo curso no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date|after:data_inicio',
            'max_inscritos' => 'required|integer',
            'material' => 'nullable|file|mimes:pdf|max:2048', // Aceita apenas arquivos PDF de até 2MB
        ]);

        DB::beginTransaction();

        try {
            $curso = new Curso();
            $curso->nome_curso = $request->nome;
            $curso->descricao = $request->descricao;
            $curso->valor = $request->valor;
            $curso->data_inicio_inscricoes = $request->data_inicio;
            $curso->data_termino_inscricoes = $request->data_termino;
            $curso->quantidade_maxima_inscritos = $request->max_inscritos;

            // Salva o arquivo PDF no diretório de armazenamento
            if ($request->hasFile('material')) {
                $material = $request->file('material');
                $materialNome = $material->getClientOriginalName(); // Nome original do arquivo
                $material->move(public_path('cursos_pdf'), $materialNome); // Move o arquivo para a pasta 'public/cursos'
                $curso->arquivo_material = $materialNome;
            }

            $curso->save();

            DB::commit();
            return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao criar o curso. Por favor, tente novamente.');
        }
    }


    /**
     * Exibe os detalhes de um curso específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.show', compact('curso'));
    }

    /**
     * Exibe o formulário para edição de um curso.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Atualiza os dados de um curso específico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date|after:data_inicio',
            'max_inscritos' => 'required|integer',
            'material' => 'nullable|file|mimes:pdf|max:2048', // Aceita apenas arquivos PDF de até 2MB
        ]);

        DB::beginTransaction();

        try {
            // Encontra o curso existente pelo ID
            $curso = Curso::findOrFail($id);

            // Atualiza os campos do curso com base nos dados do formulário
            $curso->nome_curso = $request->nome;
            $curso->descricao = $request->descricao;
            $curso->valor = $request->valor;
            $curso->data_inicio_inscricoes = $request->data_inicio;
            $curso->data_termino_inscricoes = $request->data_termino;
            $curso->quantidade_maxima_inscritos = $request->max_inscritos;

            // Verifica se um novo arquivo foi enviado e o salva
            if ($request->hasFile('material')) {
                $material = $request->file('material');
                $materialNome = $material->getClientOriginalName(); // Nome original do arquivo
                $material->move(public_path('cursos_pdf'), $materialNome); // Move o arquivo para a pasta 'public/cursos_pdf'
                $curso->arquivo_material = $materialNome;
            }

            // Salva as alterações no banco de dados
            $curso->save();

            // Commit da transação se tudo estiver OK
            DB::commit();
            
            return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
        } catch (\Exception $e) {
            // Desfazer a transação em caso de erro
            DB::rollback();

            return redirect()->back()->with('error', 'Erro ao atualizar o curso. Por favor, tente novamente.');
        }
    }


    /**
     * Remove um curso específico do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $curso = Curso::findOrFail($id);
            $curso->delete();
            DB::commit();
            return redirect()->route('cursos.index')->with('success', 'Curso excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erro ao excluir o curso. Por favor, tente novamente.');
        }
    }
}
