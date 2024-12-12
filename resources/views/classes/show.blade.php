@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Detalhes da aula selecionada')
@section('footer_card', '...')

{{-- Breadcrumb START --}}
@section('bc1')
    <li class="breadcrumb-item">Cursos</li>
    <li class="breadcrumb-item">Aulas</li>
    <li class="breadcrumb-item active" aria-current="page"><strong>Detalhes da Aula Selecionada</strong></li>
@endsection
{{-- Breadcrumb END --}}

@section('links')

    @php
        // This variable captures the course name and concatenates it into the tooltip parameter.
        $tooltipText = 'Voltar para a lista de aulas do curso: ' . $selectedClasse->course->name;
    @endphp

    <form id="deleteForm-{{ $selectedClasse->id }}" action="{{ route('classe.destroy', ['classe' => $selectedClasse->id]) }}"
        method="post" target="_self" enctype="multipart/form-data">
        @csrf
        @method('DELETE')

        <a href="{{ route('classe.index', ['course' => $selectedClasse->course_id]) }}" data-bs-toggle="tooltip"
            data-bs-placement="bottom" data-bs-title="{{ $tooltipText }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <a href="{{ route('classe.edit', ['id' => $selectedClasse->id]) }}" target="_self" data-bs-toggle="tooltip"
            data-bs-placement="bottom" data-bs-title="Editar este curso" class="btn btn-success"><i
                class="fa-solid fa-pen-to-square"></i>
        </a>

        <button type="button" class="delete-classe-button btn btn-danger"
            data-form-id="deleteForm-{{ $selectedClasse->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-title="Excluir esta aula">
            <i class="fa-solid fa-trash"></i>
    </form>
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


    {{-- {{ $selectedClasse->course->name }} --}}

    <div class="table-responsive">
        {{-- <table class="table table-striped table-hover"> --}}
        <table class="table">
            <thead>
                <tr class="text-start">
                    <th scope="col" width="220">Campo</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-start">
                    <th scope="row">Aula (ID Aula: {{ $selectedClasse->id }})</th>
                    <td>
                        <h4>{{ $selectedClasse->name }}</h4>
                    </td>
                </tr>

                <tr class="text-start">
                    <th scope="row">Conteúdo</th>
                    <td>{!! $selectedClasse->description !!}</td>
                </tr>

                <tr class="text-start">
                    <th scope="row">Status da Aula</th>
                    <td>
                        @if ($selectedClasse->status == 1)
                            <h5><span class="badge text-bg-success">Ativa</span></h5>
                        @else
                            <h5><span class="badge text-bg-danger">Inativa</span></h5>
                        @endif
                    </td>
                </tr>

                <tr class="text-start">
                    <th scope="row">Imagem de Chamada</th>
                    <td>{{ $selectedClasse->image }}</td>
                </tr>

                <tr class="text-start">
                    <th scope="row">Curso (ID Curso: {{ $selectedClasse->course->id }})</th>
                    <td><i>{{ $selectedClasse->course->name }}</i></td>
                </tr>
            </tbody>
        </table>

        {{-- <script>
            function showCustomConfirm(event) {
                // Prevents form submission.
                event.preventDefault();

                Swal.fire({
                    title: '<strong style="font-size: 20px;">Deseja realmente excluir esta aula?</strong>',
                    html: '<span style="font-size: 14px;">Esta operação não poderá ser desfeita.</span>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false, // Prevent closing when clicking outside the modal.
                    allowEscapeKey: true // Prevent closing when clicking Esc key.
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form manually after confirmation.
                        document.getElementById('deleteForm').submit();
                    }
                });
            }
        </script> --}}

    @endsection
