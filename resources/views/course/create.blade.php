@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Cadastrar novo curso')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Cancelar</a>
@endsection


@section('content')

    <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data" target="_self">
        @csrf
        @method('POST')

        <div class="row mb-3">
            <div class="col-9 text-start">
                <label for="name">Nome do Curso</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Informe o nome do curso" required />
            </div>

            <div class="col-3 text-start">
                <label for="price">Preço</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">R$</span>
                    <input type="number" step="0.01" min="0.00" id="price" name="price" class="form-control"
                        value="{{ old('price') }}" placeholder="Informe o preço do curso" aria-label="price"
                        aria-describedby="basic-addon1">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 text-start">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="3">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-8 text-start">
                <label for="image">Imagem para o Curso</label>
                <input type="file" name="image" id="image" class="form-control" value="{{ old('imagem') }}" />
            </div>

            <div class="col-4 text-start">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" selected>Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-end">
                    <hr />
                    <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;Salvar&nbsp;&nbsp;&nbsp;</button>
                    <a href="{{ route('course.index') }}" class="btn btn-secondary" target="_self">Cancelar</a>
                </div>
            </div>
        </div>

    </form>


@endsection
