@extends('layout.template1')


@section('title', 'USUÁRIOS')
@section('title_card', 'Edição da Senha do Usuário Selecionado')
@section('footer_card', 'Faça a alteração da senha do usuário selecionado e a seguir, salve.')

{{-- Breadcrumb START --}}
@section('bc1')
    <li class="breadcrumb-item active" aria-current="page"><strong>Usuários</strong></li>
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

    <form action="{{ route('user.password-update', ['id' => $userEdit->id]) }}" method="POST" enctype="multipart/form-data" target="_self">
        @csrf
        @method('PUT')

        <input type="hidden" id="id" name="id" value="{{ old('id', $userEdit->id) }}" />

        <div class="row mb-3">
            <div class="col-12 text-start">
                <h5><label for="name">Usuário: </label>
                <strong>{{ $userEdit->name }}</strong></h5>
                <hr />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-3 text-start">
                <label for="password">Nova Senha</label>
                <input type="password" id="password" name="password" class="form-control" value="{{ old('password', $userEdit->password) }}"
                    placeholder="Informe a senha do usuário" required />
            </div>

            <div class="col-3 text-start">
                <label for="password_confirmation">Confirme a Nova Senha</label>
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
