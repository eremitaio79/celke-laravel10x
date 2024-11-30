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

                    // Remove o elemento do DOM após a animação (500ms é o tempo padrão do Bootstrap)
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>
                            <a href="{{ route('course.edit') }}">Edit</a>&nbsp;|&nbsp;
                            <a href="{{ route('course.show') }}">Show</a>
                            {{-- <a href="{{ route('course.delete') }}">Delete</a> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- TABLE END --}}

        </div>
    </div>


@endsection
