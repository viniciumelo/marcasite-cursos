@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Cursos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome do Curso</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data de Início das Inscrições</th>
                    <th>Data de Término das Inscrições</th>
                    <th>Quantidade Máxima de Inscritos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $curso)
                <tr>
                    <td>{{ $curso->nome_curso }}</td>
                    <td>{{ $curso->descricao }}</td>
                    <td>{{ $curso->valor }}</td>
                    <td>{{ $curso->data_inicio_inscricoes }}</td>
                    <td>{{ $curso->data_termino_inscricoes }}</td>
                    <td>{{ $curso->quantidade_maxima_inscritos }}</td>
                    <td>
                        <a target="_blank" href="/cursos_pdf/{{ $curso->arquivo_material }}" class="btn btn-primary" style=" float: left;">Material de Apoio</a>
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-primary" style=" float: left;">Editar</a>
                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display: inline; float: left;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este curso?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
