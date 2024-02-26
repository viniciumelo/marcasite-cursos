@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Inscrição do Aluno</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('alunos.update', $aluno->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ $aluno->user->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $aluno->user->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="cpf">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $aluno->cpf }}" required>
                            </div>

                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $aluno->endereco }}" required>
                            </div>

                            <div class="form-group">
                                <label for="empresa">Empresa:</label>
                                <input type="text" class="form-control" id="empresa" name="empresa" value="{{ $aluno->empresa }}" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $aluno->telefone }}" required>
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular:</label>
                                <input type="text" class="form-control" id="celular" name="celular" value="{{ $aluno->celular }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="Estudante" {{ $aluno->tipo === 'Estudante' ? 'selected' : '' }}>Estudante</option>
                                    <option value="Profissional" {{ $aluno->tipo === 'Profissional' ? 'selected' : '' }}>Profissional</option>
                                    <option value="Associado" {{ $aluno->tipo === 'Associado' ? 'selected' : '' }}>Associado</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="curso_id">Curso:</label>
                                <select class="form-control" id="curso_id" name="curso_id" required>
                                    @foreach($cursos as $curso)
                                        <option value="{{ $curso->id }}" {{ $curso->id === $aluno->curso_id ? 'selected' : '' }}>{{ $curso->nome_curso }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password">Nova Senha:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirmação de Senha:</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
