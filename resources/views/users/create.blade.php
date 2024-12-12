@extends('layout.template1')

@section('title', 'USUÁRIOS')
@section('title_card', 'Cadastrar Novo Usuário')
@section('footer_card', 'Preencha as informações do usuário')

{{-- Breadcrumb START --}}
@section('bc1')
    <li class="breadcrumb-item">Usuários</li>
    <li class="breadcrumb-item active" aria-current="page"><strong>Cadastrar Novo Usuário</strong></li>
@endsection
{{-- Breadcrumb END --}}

@section('links')
    <a href="{{ route('user.index') }}" target="_self" class="btn btn-secondary">Cancelar</a>
@endsection


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

    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" target="_self">
        @csrf
        @method('POST')

        <div class="row mb-3">
            <div class="col-12 text-start">
                <label for="name">Nome do Usuário</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Informe o nome do usuário" required />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6 text-start">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                    placeholder="Informe o e-mail do usuário" required />
            </div>

            <div class="col-3 text-start">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}"
                    placeholder="Informe a senha do usuário" required />
            </div>

            <div class="col-3 text-start">
                <label for="password_confirmation">Confirme a Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @error('password')
                    <small class="text-danger">{!! $message !!}</small>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="row mt-3">
                <div class="col-12 text-end">
                    <hr />
                    <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;Salvar&nbsp;&nbsp;&nbsp;</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary" target="_self">Cancelar</a>
                </div>
            </div>
        </div>

    </form>


@endsection
