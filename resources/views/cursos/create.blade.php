@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">CADASTRO/EDIÇÃO DE CURSO</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cursos.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">Nome do Curso</label>
                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autofocus>
                                    @error('nome')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descricao" class="col-md-4 col-form-label text-md-right">Descrição</label>
                                <div class="col-md-6">
                                    <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" required>{{ old('descricao') }}</textarea>
                                    @error('descricao')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="valor" class="col-md-4 col-form-label text-md-right">Valor</label>
                                <div class="col-md-6">
                                    <input id="valor" type="number" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{ old('valor') }}" required>
                                    @error('valor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="data_inicio" class="col-md-4 col-form-label text-md-right">Data de Início das Inscrições</label>
                                <div class="col-md-6">
                                    <input id="data_inicio" type="date" class="form-control @error('data_inicio') is-invalid @enderror" name="data_inicio" value="{{ old('data_inicio') }}" required>
                                    @error('data_inicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="data_termino" class="col-md-4 col-form-label text-md-right">Data de Término das Inscrições</label>
                                <div class="col-md-6">
                                    <input id="data_termino" type="date" class="form-control @error('data_termino') is-invalid @enderror" name="data_termino" value="{{ old('data_termino') }}" required>
                                    @error('data_termino')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="max_inscritos" class="col-md-4 col-form-label text-md-right">Quantidade Máxima de Inscritos</label>
                                <div class="col-md-6">
                                    <input id="max_inscritos" type="number" class="form-control @error('max_inscritos') is-invalid @enderror" name="max_inscritos" value="{{ old('max_inscritos') }}" required>
                                    @error('max_inscritos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="material" class="col-md-4 col-form-label text-md-right">Upload de arquivo com material</label>
                                <div class="col-md-6">
                                    <input id="material" type="file" class="form-control-file @error('material') is-invalid @enderror" name="material" required>
                                    @error('material')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Cadastrar Curso
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
