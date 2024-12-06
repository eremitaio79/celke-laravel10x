@extends('layout.template1')

@section('title', 'CURSOS')


@section('title_card')
    @php
        $nomeCursoSelecionado = $selectedCourse->name;
    @endphp

    Cadastrar Nova Aula no Curso: <strong>{{ $nomeCursoSelecionado }}</strong>

@endsection


@section('footer_card', '...')

@section('links')
    <a href="#" class="btn btn-primary">x</a>
@endsection


@section('content')

    {{-- MSG ERROR --}}
    @if (session('msgError'))
        <div id="error-alert" class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="text-start">
                <strong>{{ session('msgError') }}</strong>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <script>
        // JavaScript para fazer o alerta desaparecer e liberar o espaço
        document.addEventListener("DOMContentLoaded", function() {
            const alertElement = document.getElementById("error-alert");
            if (alertElement) {
                setTimeout(() => {
                    alertElement.classList.remove("show"); // Remove show.
                    alertElement.classList.add("fade"); // Aplica a animação de saída

                    // Remove the DOM element after animation (500ms is the default time at Boorstrap)
                    setTimeout(() => {
                        alertElement.remove();
                    }, 500); // Wait animation finishes before hide.
                }, 5000); // 5000 ms = 5 seconds.
            }
        });
    </script>


    {{-- MSG SUCCESS --}}
    @if (session('msgSuccess'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="text-start">
                <strong>{{ session('msgSuccess') }}</strong>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <script>
        // JavaScript para fazer o alerta desaparecer e liberar o espaço
        document.addEventListener("DOMContentLoaded", function() {
            const alertElement = document.getElementById("success-alert");
            if (alertElement) {
                setTimeout(() => {
                    alertElement.classList.remove("show"); // Remove a exibição
                    alertElement.classList.add("fade"); // Exit animation is applied.

                    // Remove the DOM element after animation (500ms is the default time at Boorstrap).
                    setTimeout(() => {
                        alertElement.remove();
                    }, 500); // Wait for animation to finish before hiding.
                }, 5000); // 5000 ms = 5 seconds.
            }
        });
    </script>
    {{-- {{ $selectedCourse->id }} --}}

    <form action="{{ route('classe.store') }}" method="POST" enctype="multipart/form-data" target="_self">
        @csrf
        @method('POST')

        <input type="hidden" id="course_id" name="course_id" value="{{ $selectedCourse->id }}" />

        <div class="row mb-3">
            <div class="col-12 text-start">
                <label for="name">Nome da Aula</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Informe o nome da aula" required />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 text-start">
                <label for="description">Descrição / Conteúdo da Aula</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="3">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-4 text-start">
                <label for="image">Imagem para a Aula</label>
                <input type="file" name="image" id="image" class="form-control" value="{{ old('imagem') }}" />
            </div>

            <div class="col-4 text-start">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" selected>Ativa</option>
                    <option value="0">Inativa</option>
                </select>
            </div>

            <div class="col-4 text-start">
                <label for="order_classe">Ordem da Aula</label>
                <input type="text" id="order_classe" name="order_classe" class="form-control"
                    value="{{ old('order_classe') }}" placeholder="Informe a ordem da aula" required />
            </div>

            <div class="row mt-3">
                <div class="col-12 text-end">
                    <hr />
                    <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;Salvar&nbsp;&nbsp;&nbsp;</button>
                    <a href="{{ route('classe.index', ['course' => $selectedCourse->id]) }}" class="btn btn-secondary" target="_self">Cancelar</a>
                </div>
            </div>
        </div>

    </form>

@endsection
