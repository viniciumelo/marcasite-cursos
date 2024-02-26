@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Curso</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cursos.update', $curso->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nome">Nome do Curso:</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $curso->nome_curso }}">
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <textarea class="form-control" id="descricao" name="descricao">{{ $curso->descricao }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor:</label>
                            <input type="text" class="form-control" id="valor" name="valor" value="{{ $curso->valor }}">
                        </div>

                        <div class="form-group">
                            <label for="data_inicio">Data de Início das Inscrições:</label>
                            <?php $dataInicio = date('Y-m-d', strtotime($curso->data_inicio_inscricoes)); ?>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="{{ $dataInicio }}">
                        </div>                        

                        <div class="form-group">
                            <label for="data_termino">Data de Término das Inscrições:</label>
                            <?php $dataTermino = date('Y-m-d', strtotime($curso->data_termino_inscricoes)); ?>
                            <input type="date" class="form-control" id="data_termino" name="data_termino" value="{{ $dataTermino }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="max_inscritos">Quantidade Máxima de Inscritos:</label>
                            <input type="number" class="form-control" id="max_inscritos" name="max_inscritos" value="{{ $curso->quantidade_maxima_inscritos }}">
                        </div>

                        <div class="form-group">
                            <label for="material">Arquivo de Material:</label>
                            <input type="file" class="form-control-file" id="material" name="material">
                            @if ($curso->arquivo_material)
                                <p>Arquivo atual: <a href="/cursos_pdf/{{ $curso->arquivo_material }}" target="_blank">{{ $curso->arquivo_material }}</a></p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
