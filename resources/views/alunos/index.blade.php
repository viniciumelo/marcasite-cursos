@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inscritos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data de Inscrição</th>
                <th>Categoria</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>UF</th>
                <th>Status</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
            <tr>
                <td>{{ $aluno->user->name }}</td>
                <td>{{ $aluno->created_at->format('d/m/Y') }}</td>
                <td>{{ $aluno->tipo }}</td>
                <td>{{ $aluno->cpf }}</td>
                <td>{{ $aluno->user->email }}</td>
                <td>{{ $aluno->endereco }}</td>
                <td>{{ $aluno->status }}</td>
                <td>{{ $aluno->curso->valor }}</td>
                <td>
                    <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mb-3">
        <a href="{{ route('alunos.exportExcel') }}" class="btn btn-success">Exportar Excel</a>
        <a href="{{ route('alunos.exportPDF') }}" class="btn btn-danger">Exportar PDF</a>
    </div>
</div>
@endsection
