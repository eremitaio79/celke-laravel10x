@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Listagem dos cursos cadastrados')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Cancelar</a>
@endsection


@section('content')

    {{-- Request validations --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                {!! $error !!}<br />
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <script>
        // Aguarda 5 segundos e remove o alerta
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show'); // Esconde o alerta
                alert.classList.add('fade'); // Aplica a transição de saída
                setTimeout(() => alert.remove(), 300); // Remove do DOM após a animação
            }
        }, 5000); // 5 segundos
    </script>

    <form action="{{ route('course.update', ['id' => $editCourse->id]) }}" method="POST" enctype="multipart/form-data"
        target="_self">
        @csrf
        @method('PUT')

        {{-- <input type="hidden" id="id" name="id" value="{{ $editCourse->id }}" /> --}}

        <div class="row mb-3">
            <div class="col-9 text-start">
                <label for="name">Nome do Curso</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', $editCourse->name) }}" placeholder="Informe o nome do curso" required />
            </div>

            <div class="col-3 text-start">
                <label for="price">Preço</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">R$</span>
                    <input type="number" step="0.01" min="0.00" id="price" name="price" class="form-control"
                        value="{{ old('price', $editCourse->price) }}" placeholder="Informe o preço do curso"
                        aria-label="price" aria-describedby="basic-addon1">
                </div>
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
                <input type="file" name="image" id="image" class="form-control"
                    value="{{ old('image', $editCourse->image) }}" />

                @if ($editCourse->image)
                    <small class="d-block mt-4 mb-2">Imagem atual:</small>
                    <img src="{{ $editCourse->image }}" alt="Imagem do Curso" class="img-thumbnail"
                        style="max-width: 500px;">
                    <small class="d-block mt-2 text-muted">Selecione um novo arquivo para substituir a imagem atual.</small>
                @endif
            </div>


            <div class="col-4 text-start">
                <label for="status">Status do Curso</label>
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
