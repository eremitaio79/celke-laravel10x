@extends('layout.template0')


@section('title', 'ACESSO')
@section('title_card', 'Acesso ao Sistema')

@section('footer_card')
    <div class="row">
        <div class="col-12">
            Caso ainda não possua usuário, <strong>
                <a href="#" target="_self" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                     clique aqui
                </a>
            </strong> para cadastrar.
        </div>
    </div>
@endsection

{{-- Breadcrumb START --}}
@section('bc1')
    <li class="breadcrumb-item active" aria-current="page"><strong>Login de Acesso</strong></li>
@endsection
{{-- Breadcrumb END --}}


{{-- @section('links')
    <a href="#" class="btn btn-primary">Novo</a>
@endsection --}}


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

    <div class="row justify-content-center align-items-center">
        <div class="col-4">
            <form action="" id="formLogin" method="POST" enctype="multipart/form-data" target="_self">
                <div class="row mb-3">
                    <div class="col-12 text-start">
                        <label for="username" class="for">E-mail de Acesso</label>
                        <input type="text" id="username" name="username" class="form-control"
                            placeholder="Informe o e-mail incluído no cadastro" required />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 text-start">
                        <label for="password" class="for">Senha de Acesso</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Informe a senha de acesso" required />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            &nbsp;&nbsp;&nbsp;&nbsp;Entrar&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Limpa todos os inputs ao carregar a página
            $('#formLogin input').val('');
        });
    </script>

@endsection
