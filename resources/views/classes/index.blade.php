@extends('layout.template1')

@section('title', 'AULAS DO CURSO')
@section('title_card', 'Aulas do curso selecionado')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Voltar aos cursos"
        target="_self" class="btn btn-secondary">Voltar</a>
    <a href="#" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
        data-bs-title="Cadastrar nova aula neste curso">Nova Aula</a>
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

    @forelse ($classes as $classe)
        <div class="card mb-4 text-start">
            <div class="card-header">
                Curso: <strong>{{ $classe->course->name }}</strong>
            </div>
            <div class="card-body">
                <h5 class="card-title">Aula {{ $classe->id }}: {{ $classe->name }}</h5>
                <span style="font-size:12px;"><strong>Ordem da aula: {{ $classe->order_classe }}</strong></span>
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
                        Criada em:
                        <strong>{{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}</strong>&nbsp;|&nbsp;
                        Atualizada em:
                        <strong>{{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}</strong>
                    </span>
                </p>
                <hr />
                <form id="deleteForm" action="#" target="_self" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a type="button" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Editar esta aula">&nbsp;<i class="fa-solid fa-pen-to-square"></i>&nbsp;</a>

                        <a href="{{ route('classe.show', ['id' => $classe->id]) }}" type="button" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Detalhes desta aula">&nbsp;<i class="fa-solid fa-eye"></i>&nbsp;</a>

                        <button type="button" onclick="showCustomConfirm(event)" class="btn btn-sm btn-danger"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Excluir esta aula">&nbsp;<i
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

    <script>
        function showCustomConfirm(event) {
            // Impede o envio do formulário
            event.preventDefault();

            Swal.fire({
                title: '<strong style="font-size: 20px;">Deseja realmente excluir esta aula?</strong>',
                html: '<span style="font-size: 14px;">Esta operação não poderá ser desfeita.</span>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false, // Impede fechar ao clicar fora do modal
                allowEscapeKey: false // Impede fechar ao pressionar Esc
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submete o formulário manualmente após a confirmação
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>

@endsection
