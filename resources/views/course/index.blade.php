@extends('layout.template1')

{{-- SECTIONS --}}
@section('title', 'CURSOS')
@section('title_card', 'Listagem dos cursos cadastrados')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.create') }}" target="_self" class="btn btn-primary">Novo</a>
@endsection


{{-- CONTENT --}}
@section('content')

    {{-- MSG --}}
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
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-start">
                            <th scope="col" width="50">ID</th>
                            <th scope="col" width="300">Nome</th>
                            <th scope="col" width="500">Descritivo</th>
                            <th scope="col" width="100">Status</th>
                            <th scope="col" width="220">Criação</th>
                            <th scope="col" width="100">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coursesList as $course)
                            <tr class="text-start">
                                <th scope="row">{{ $course->id }}</th>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->status ? 'Ativo' : 'Inativo' }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    <a href="{{ route('course.edit', ['id' => $course->id]) }}">Edit</a>&nbsp;|&nbsp;
                                    <a href="{{ route('course.show', ['id' => $course->id]) }}">Show</a>
                                    {{-- <a href="{{ route('course.delete') }}">Delete</a> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

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


@endsection
