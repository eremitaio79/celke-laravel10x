@extends('layout.template1')

@section('title', 'AULAS DO CURSO')
@section('title_card', 'Aulas do curso selecionado')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Voltar</a>
    <a href="#" class="btn btn-primary">Nova Aula</a>
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
                    alertElement.classList.remove("show"); // Remove a exibição
                    alertElement.classList.add("fade"); // Aplica a animação de saída

                    // Remove the DOM element after animation (500ms is the default time at Boorstrap)
                    setTimeout(() => {
                        alertElement.remove();
                    }, 500); // Aguarda a animação terminar antes de remover
                }, 5000); // 5000 ms = 5 segundos
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
                    alertElement.classList.add("fade"); // Aplica a animação de saída

                    // Remove the DOM element after animation (500ms is the default time at Boorstrap)
                    setTimeout(() => {
                        alertElement.remove();
                    }, 500); // Wait for animation to finish before hiding.
                }, 5000); // 5000 ms = 5 seconds.
            }
        });
    </script>

    @forelse ($classes as $classe)
        <div class="card mb-4 text-start">
            <div class="card-header">
                Curso: <strong>{{ $classe->course->name }}</strong>
            </div>
            <div class="card-body">
                <h5 class="card-title">Aula {{ $classe->id }}: {{ $classe->name }}</h5>
                <p class="card-text">{{ $classe->description }}</p>
                <p>
                    @if ($classe->status == 1)
                        <h5><span class="badge text-bg-success">Disponível</span></h5>
                    @else
                        <h5><span class="badge text-bg-danger">Indisponível</span></h5>
                    @endif
                </p>
                <p>
                    <span style="font-size: 12px;">
                        Criado em: <strong>{{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}</strong>&nbsp;|&nbsp;
                        Atualizado em: <strong>{{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}</strong>
                    </span>
                </p>
                <hr />
                <form action="#" target="_self" method="POST" enctype="multipart/form-data">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a type="button" class="btn btn-sm btn-success">&nbsp;<i
                                class="fa-solid fa-pen-to-square"></i>&nbsp;</a>
                        <a type="button" class="btn btn-sm btn-warning">&nbsp;<i class="fa-solid fa-eye"></i>&nbsp;</a>
                        <button type="submit" class="btn btn-sm btn-danger">&nbsp;<i
                                class="fa-solid fa-trash"></i>&nbsp;</button>
                    </div>


                </form>
            </div>
        </div>

    @empty

        <div class="alert alert-warning" role="alert">
            Nenhuma aula disponível neste curso.
        </div>
    @endforelse

@endsection
