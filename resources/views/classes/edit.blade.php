@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Editar esta Aula')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('classe.index', ['course' => $selectedClasse->course->id]) }}" class="btn btn-secondary"
        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cancelar as alterações"><i
            class="fa-solid fa-arrow-left"></i></a>
@endsection


@section('content')

    {{-- {{ $selectedClasse->name }}
    {{ $selectedClasse->course->name }} --}}

    <form action="{{ route('classe.update', ['id' => $selectedClasse->id]) }}" method="POST" enctype="multipart/form-data"
        target="_self">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-8 text-start">
                <label for="name">Nome da Aula</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', $selectedClasse->name) }}" placeholder="Informe o nome da aula" required />
            </div>

            <div class="col-4 text-start">
                <label for="course_id">Esta Aula Pertence ao Curso</label>
                <select name="course_id" id="course_id" class="form-control">
                    <option value="" disabled>Selecione um curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $selectedClasse->course->id }}"
                            {{ $selectedClasse->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 text-start">
                <label for="description">Descrição / Conteúdo da Aula</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="3">{{ old('description', $selectedClasse->description) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-4 text-start">
                <label for="image">Imagem para a Aula</label>
                <input type="file" name="image" id="image" class="form-control"
                    value="{{ old('imagem', $selectedClasse->image) }}" />
            </div>

            <div class="col-4 text-start">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $selectedClasse->status == 1 ? 'selected' : '' }}>Ativa</option>
                    <option value="0" {{ $selectedClasse->status == 0 ? 'selected' : '' }}>Inativa</option>
                </select>
            </div>

            <div class="col-4 text-start">
                <label for="order_classe">Ordem da Aula</label>
                <input type="text" id="order_classe" name="order_classe" class="form-control"
                    value="{{ old('order_classe', $selectedClasse->order_classe) }}" placeholder="Informe a ordem da aula"
                    required />
            </div>

            <div class="row mt-3">
                <div class="col-12 text-end">
                    <hr />
                    <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="Salvar as alterações feitas nesta aula">&nbsp;&nbsp;&nbsp;Salvar&nbsp;&nbsp;&nbsp;</button>
                    <a href="{{ route('classe.index', ['course' => $selectedClasse->course->id]) }}"
                        class="btn btn-secondary" target="_self" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="Cancelar as alterações">Cancelar</a>
                </div>
            </div>
        </div>

    </form>

@endsection
