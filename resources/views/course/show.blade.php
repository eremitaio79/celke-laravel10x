@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Detalhes do curso selecionado')
@section('footer_card', '...')

@section('links')
    <form id="deleteForm" action="{{ route('course.destroy', ['id' => $selectedCourse->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')

        <a href="{{ route('course.index') }}" target="_self" data-bs-toggle="tooltip"
        data-bs-placement="bottom" data-bs-title="Lista de cursos" class="btn btn-secondary"><i class="fa-solid fa-list"></i></a>
        <button type="button" onclick="showCustomConfirm(event)" data-bs-toggle="tooltip"
        data-bs-placement="bottom" data-bs-title="Excluir este curso" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
        <a href="{{ route('course.edit', ['id' => $selectedCourse->id]) }}" target="_self" data-bs-toggle="tooltip"
            data-bs-placement="bottom" data-bs-title="Editar este curso" class="btn btn-success"><i
                class="fa-solid fa-pen-to-square"></i></a>
    </form>
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
                <th scope="row">Preço</th>
                @php
                    $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
                @endphp
                <td>{{ $formatter->formatCurrency($selectedCourse->price, 'BRL') }}</td>
            </tr>
            <tr>
                <th scope="row">Imagem</th>
                <td>
                    {{ $selectedCourse->image }}
                    @if ($selectedCourse->image != '')
                        <hr />
                        <img src="{{ $selectedCourse->image }}" alt="Imagem do Curso" class="img-thumbnail"
                            style="max-width: 300px;">
                    @else
                        Sem imagem
                    @endif
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

    <script>
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
