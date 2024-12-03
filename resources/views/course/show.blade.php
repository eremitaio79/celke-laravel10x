@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Detalhes do curso selecionado')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Lista de Cursos</a>
    <a href="{{ route('course.edit', ['id' => $selectedCourse->id]) }}" target="_self"
        class="btn btn-success">&nbsp;&nbsp;&nbsp;Editar&nbsp;&nbsp;&nbsp;</a>
@endsection


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

    <table class="table">
        <thead class="text-start">
            <tr>
                <th scope="col" style="width: 12%;">Campo</th>
                <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody class="text-start">
            <tr>
                <th scope="row">ID</th>
                <td>{{ $selectedCourse->id }}</td>
            </tr>
            <tr>
                <th scope="row">Curso</th>
                <td><strong>{{ $selectedCourse->name }}</strong></td>
            </tr>
            <tr>
                <th scope="row">Descrição</th>
                <td>{{ $selectedCourse->description }}</td>
            </tr>
            <tr>
                <th scope="row">Imagem</th>
                <td>
                    {{ $selectedCourse->image }}
                    <hr />
                    <img src="{{ $selectedCourse->image }}" alt="Imagem do Curso" class="img-thumbnail" style="max-width: 300px;">
                </td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td>
                    @if ($selectedCourse->status == 1)
                        <h5><span class="badge text-bg-success">Ativo</span></h5>
                    @else
                        <h5><span class="badge text-bg-danger">Inativo</span></h5>
                    @endif

                </td>
            </tr>
            <tr>
                <th scope="row">Criação</th>
                <td>{{ \Carbon\Carbon::parse($selectedCourse->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}
                </td>
            </tr>
            <tr>
                <th scope="row">Atualização</th>
                <td>{{ \Carbon\Carbon::parse($selectedCourse->updated_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}
                </td>
            </tr>
        </tbody>
    </table>

@endsection
