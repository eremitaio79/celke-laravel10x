@extends('layout.template0')


@section('title', 'ACESSO')

@section('title_card')
    <i class="fa-solid fa-user"></i>&nbsp;Acesso ao Sistema
@endsection

@section('footer_card')
    <div class="row">
        <div class="col-12">
            Caso ainda não possua usuário, &nbsp;<strong>
                <a href="{{ route('user.login.create') }}" target="_self"
                    class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    clique aqui
                </a>
            </strong>&nbsp;&nbsp;para cadastrar.
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

    {{-- Request validations --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                {!! $error !!}<br />
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <script>
        // Aguarda 5 segundos e remove o alerta
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show'); // Esconde o alerta
                alert.classList.add('fade'); // Aplica a transição de saída
                setTimeout(() => alert.remove(), 300); // Remove do DOM após a animação
            }
        }, 5000); // 5 segundos
    </script>

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
        <div class="col-3">
            <form action="{{ route('login.process') }}" id="formLogin" method="POST" enctype="multipart/form-data"
                target="_self">
                @csrf
                @method('POST')

                <div class="row mb-2">
                    <div class="col-12 text-start">
                        <label for="email" class="for">E-mail de Acesso</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" class="form-control" aria-label="email"
                                aria-describedby="basic-addon1" value="{{ old('email') }}"
                                placeholder="Informe o e-mail incluído no cadastro">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 text-start">
                        <label for="password" class="for">Senha de Acesso</label>
                        <input type="password" id="password" name="password" class="form-control"
                            value="{{ old('password') }}" placeholder="Informe a senha">
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
