@extends('layout.template1')

@section('title', 'USUÁRIOS')
@section('title_card', 'Detalhes do usuário selecionado')
@section('footer_card', 'Informações detalhadas sobre o usuário selecionado.')

{{-- Breadcrumb START --}}
@section('bc1')
    <li class="breadcrumb-item">Usuários</li>
    <li class="breadcrumb-item active" aria-current="page"><strong>Detalhes do Usuário Selecionado</strong></li>
@endsection
{{-- Breadcrumb END --}}

@section('links')
    <form id="deleteForm-{{ $selectedUser->id }}" action="{{ route('user.destroy', ['id' => $selectedUser->id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')

        <a href="{{ route('user.index') }}" target="_self" data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-title="Lista de Usuários" class="btn btn-secondary"><i class="fa-solid fa-list"></i></a>
        <a href="{{ route('user.edit', ['id' => $selectedUser->id]) }}" target="_self" data-bs-toggle="tooltip"
            data-bs-placement="bottom" data-bs-title="Editar este usuário" class="btn btn-success"><i
                class="fa-solid fa-pen-to-square"></i></a>
        <button type="button" class="delete-user-button btn btn-danger" data-form-id="deleteForm-{{ $selectedUser->id }}"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Excluir esta usuário">
            <i class="fa-solid fa-trash"></i>
        </button>
        {{-- <button type="button" onclick="showCustomConfirm(event)" data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-title="Excluir este curso" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button> --}}
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
                <td>{{ $selectedUser->id }}</td>
            </tr>

            <tr>
                <th scope="row">Nome</th>
                <td><strong>{{ $selectedUser->name }}</strong></td>
            </tr>

            <tr>
                <th scope="row">E-mail</th>
                <td>{{ $selectedUser->email }}</td>
            </tr>
            
            <tr>
                <th scope="row">Nível de Acesso</th>
                <td>
                    @forelse ($selectedUser->getRoleNames() as $role)
                        <strong>{{ $role }}</strong>
                    @empty
                        
                    @endforelse
                </td>
            </tr>

            <tr>
                <th scope="row">Criado em</th>
                <td>{{ \Carbon\Carbon::parse($selectedUser->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}</td>
            </tr>

            <tr>
                <th scope="row">Atualizado em</th>
                <td>{{ \Carbon\Carbon::parse($selectedUser->updated_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}</td>
            </tr>
        </tbody>
    </table>

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
                allowEscapeKey: false // Impede fechar ao pressionar Esc
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submete o formulário manualmente após a confirmação
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script> --}}

@endsection
