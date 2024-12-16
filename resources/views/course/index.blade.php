@extends('layout.template1')

{{-- SECTIONS --}}
@section('title', 'CURSOS')
@section('title_card', 'Listagem dos Cursos Cadastrados')

@section('bc1')
    <li class="breadcrumb-item active" aria-current="page"><strong>Cursos</strong></li>
@endsection

@section('bc2')

@endsection

@section('footer_card')
    Total de cursos disponíveis: <strong>{{ $totalCourses }} cursos</strong>.
@endsection

@section('links')
    <a href="{{ route('allclasse.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
        data-bs-title="Ver todas as aulas" target="_self" class="btn btn-secondary">Todas as Aulas</a>
    <a href="{{ route('course.create') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
        data-bs-title="Cadastrar novo curso" target="_self" class="btn btn-primary">Novo Curso</a>
@endsection


{{-- CONTENT --}}
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
                    }, 500); // Aguarda a animação terminar antes de remover
                }, 5000); // 5000 ms = 5 segundos
            }
        });
    </script>




    <div class="row">
        <div class="col-12 mb-3">

            {{-- TABLE START --}}
            @if ($coursesList->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-start">
                                <th scope="col" width="50">ID</th>
                                <th scope="col" class="text-truncate" style="max-width: 150px;">Nome</th>
                                <th scope="col" class="d-none d-lg-table-cell text-truncate" style="max-width: 250px;">
                                    Descritivo</th>
                                <th scope="col" class="d-none d-md-table-cell text-truncate" width="120">Preço</th>
                                <th scope="col" width="100">Status</th>
                                <th scope="col" class="d-none d-md-table-cell" width="220">Criação</th>
                                <th scope="col" width="150">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coursesList as $course)
                                <tr class="text-start">
                                    <th scope="row">{{ $course->id }}</th>
                                    <td class="text-truncate" style="max-width: 150px;"><strong>{{ $course->name }}</strong>
                                    </td>
                                    <td class="d-none d-lg-table-cell text-truncate" style="max-width: 250px;">
                                        {{ $course->description }}</td>
                                    @php
                                        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
                                    @endphp
                                    <td class="d-none d-md-table-cell">
                                        {{ $formatter->formatCurrency($course->price, 'BRL') }}</td>
                                    {{-- <td>{{ $course->status ? 'Ativo' : 'Inativo' }}</td> --}}
                                    <td>
                                        @if ($course->status == 1)
                                            <h5><span class="badge text-bg-success">Ativo</span></h5>
                                        @else
                                            <h5><span class="badge text-bg-danger">Inativo</span></h5>
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td>
                                        <form id="deleteForm-{{ $course->id }}" action="{{ route('course.destroy', ['id' => $course->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')

                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Editar curso"
                                                    href="{{ route('course.edit', ['id' => $course->id]) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Detalhes do curso"
                                                    href="{{ route('course.show', ['id' => $course->id]) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>

                                                <button type="button" class="delete-course-button btn btn-sm btn-danger"
                                                    data-form-id="deleteForm-{{ $course->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Excluir esta aula">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                <a type="button" class="btn btn-secondary btn-sm position-relative"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Aulas deste curso: {{ $course->classe_count }} aulas"
                                                    href="{{ route('classe.index', ['course' => $course->id]) }}">
                                                    <i class="fa-solid fa-clipboard"></i>
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                        {{ $course->classe_count }}
                                                        <span class="visually-hidden">0</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $coursesList->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    Nenhum curso disponível no momento!
                </div>
            @endif
            {{-- TABLE END --}}

        </div>
    </div>

    {{-- <script>
        function showCustomConfirm(event) {
            // Impede o envio do formulário
            event.preventDefault();

            Swal.fire({
                title: '<strong style="font-size: 20px;">Deseja realmente excluir este curso?</strong>',
                html: '<span style="font-size: 14px;">Esta operação não poderá ser desfeita.</span>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false, // Impede fechar ao clicar fora do modal
                allowEscapeKey: true // Impede fechar ao pressionar Esc
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submete o formulário manualmente após a confirmação
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script> --}}

@endsection
