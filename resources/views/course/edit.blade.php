@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Listagem dos cursos cadastrados')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Cancelar</a>
@endsection


@section('content')

    <form action="{{ route('course.update', ['id' => $editCourse->id]) }}" method="POST" enctype="multipart/form-data" target="_self">
        @csrf
        @method('PUT')

        <input type="hidden" id="id" name="id" value="{{ $editCourse->id }}" />

        <div class="row mb-3">
            <div class="col-12 text-start">
                <label for="name">Nome do Curso</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $editCourse->name) }}"
                    placeholder="Informe o nome do curso" required />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 text-start">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="3">{{ old('description', $editCourse->description) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-8 text-start">
                <label for="image">Imagem para o Curso</label>
                <input type="file" name="image" id="image" class="form-control" value="{{ old('image', $editCourse->image) }}" />

                @if ($editCourse->image)
                    <small class="d-block mt-4 mb-2">Imagem atual:</small>
                    <img src="{{ $editCourse->image }}" alt="Imagem do Curso" class="img-thumbnail" style="max-width: 500px;">
                    <small class="d-block mt-2 text-muted">Selecione um novo arquivo para substituir a imagem atual.</small>
                @endif
            </div>


            <div class="col-4 text-start">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $editCourse->status == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ $editCourse->status == 0 ? 'selected' : '' }}>Inativo</option>
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
