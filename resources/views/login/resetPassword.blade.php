@extends('layout.template1')


@section('title', 'ACESSO')
@section('title_card', 'Criar Nova Senha de Acesso')
@section('footer_card', 'Crie sua nova senha de acesso.')

{{-- Breadcrumb START --}}
@section('bc1')
<li class="breadcrumb-item" aria-current="page">Usuários</li>
<li class="breadcrumb-item active" aria-current="page"><strong>Reset Senha de Acesso</strong></li>
@endsection
{{-- Breadcrumb END --}}


@section('links')
    <a href="{{ route('root') }}" target="_self" class="btn btn-secondary">Cancelar</a>
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

<form action="{{ route('password.reseting.submit')}}" method="POST" enctype="multipart/form-data"
    target="_self">
    @csrf
    @method('POST')

    <input type="hidden" id="token" name="token" value="{{ $token }}" />

    <div class="row mb-4">
        <div class="col-6 text-start">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control"
                placeholder="Informe seu e-mail de cadastro" value="{{ old('email') }}" />
        </div>

        <div class="col-3 text-start">
            <label for="password">Nova Senha</label>
            <input type="password" id="password" name="password" class="form-control"
                placeholder="Crie sua nova senha" value="" />
        </div>

        <div class="col-3 text-start">
            <label for="password_confirmation">Confirme a Nova Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                placeholder="Confirme sua nova senha" value="{{ old('password_confirmation') }}" />
        </div>
    </div>

    <div class="row mb-3">
        <div class="row mt-3">
            <div class="col-12 text-end">
                <hr />
                <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;Atualizar Senha&nbsp;&nbsp;&nbsp;</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary" target="_self">Cancelar</a>
            </div>
        </div>
    </div>
</form>

@endsection