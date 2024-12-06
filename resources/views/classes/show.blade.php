@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Detalhes da aula selecionada')
@section('footer_card', '...')

@section('links')

    @php
        // This variable captures the course name and concatenates it into the tooltip parameter.
        $tooltipText = 'Voltar para a lista de aulas do curso: ' . $selectedClasse->course->name;
    @endphp

    <form action="#" target="_self" enctype="multipart/form-data">
        <a href="{{ route('classe.index', ['course' => $selectedClasse->course_id]) }}" data-bs-toggle="tooltip"
            data-bs-placement="bottom" data-bs-title="{{ $tooltipText }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <a href="{{ route('classe.edit', ['id' => $selectedClasse->id]) }}" target="_self" data-bs-toggle="tooltip"
            data-bs-placement="bottom" data-bs-title="Editar este curso" class="btn btn-success"><i
                class="fa-solid fa-pen-to-square"></i>
        </a>

        <button type="button" onclick="showCustomConfirm(event)" data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-title="Excluir esta aula" class="btn btn-danger"><i class="fa-solid fa-trash"></i>
        </button>
    </form>
@endsection


@section('content')

    {{-- {{ $selectedClasse->course->name }} --}}

    <div class="table-responsive">
        <table class="table table-striped table-hover">
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

        <script>
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
        </script>

    @endsection
