@extends('layout.template1')


@section('title', 'USUÁRIOS')
@section('title_card', 'Listagem dos Usuários Cadastrados')

@section('footer_card')
    Usuários cadastrados:
    @if ($totalUsers != 1)
        <strong>{{ $totalUsers }}</strong> usuários
    @else
        <strong>{{ $totalUsers }}</strong> usuário
    @endif
@endsection

{{-- Breadcrumb START --}}
@section('bc1')
    <li class="breadcrumb-item active" aria-current="page"><strong>Usuários</strong></li>
@endsection
{{-- Breadcrumb END --}}


@section('links')
    <a href="{{ route('user.create') }}" target="_self" class="btn btn-primary">Novo Usuário</a>
@endsection


{{-- Content START --}}
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
            @if ($userList->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-start">
                                <th scope="col" width="50">ID</th>
                                <th scope="col" class="text-truncate" style="max-width: 150px;">Nome</th>
                                <th scope="col" class="d-none d-md-table-cell" width="220">Criação</th>
                                <th scope="col" width="150">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $user)
                                <tr class="text-start">
                                    <th scope="row">{{ $user->id }}</th>
                                    <td class="text-truncate" style="max-width: 150px;"><strong>{{ $user->name }}</strong>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        {{ \Carbon\Carbon::parse($user->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td>
                                        <form id="deleteForm-{{ $user->id }}"
                                            action="{{ route('user.destroy', ['id' => $user->id]) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')

                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Editar usuário"
                                                    href="{{ route('user.edit', ['id' => $user->id]) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Editar senha do usuário"
                                                    href="{{ route('user.password-edit', ['id' => $user->id]) }}">
                                                    <i class="fa-solid fa-key"></i>
                                                </a>

                                                <a type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Detalhes do usuário"
                                                    href="{{ route('user.show', ['id' => $user->id]) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>


                                                <button type="button" class="delete-user-button btn btn-sm btn-danger"
                                                    data-form-id="deleteForm-{{ $user->id }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Excluir este usuário">
                                                    &nbsp;<i class="fa-solid fa-trash"></i>&nbsp;
                                                </button>
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
                        {{ $userList->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    Nenhum usuário disponível no momento!
                </div>
            @endif
            {{-- TABLE END --}}

        </div>
    </div>

@endsection
{{-- Content END --}}
