@extends('layout.template1')


@section('title', 'CURSOS')
@section('title_card', 'Gerenciador de Cursos')
@section('footer_card', 'Selecione a opção desejada.')

{{-- Breadcrumb START --}}
@section('bc1')
    <li class="breadcrumb-item active" aria-current="page"></li>
@endsection
{{-- Breadcrumb END --}}


@section('links')
    {{-- <a href="#" class="btn btn-primary">Novo</a> --}}
@endsection


@section('content')

    <div class="row">
        <div class="col-6">
            <div class="card">
                <img src="{{ asset('images/cursos.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Cursos</h5>
                    <p class="card-text">
                        Utilize o gerenciador de cursos para criar novos cursos, novas aulas e conteúdos para as aulas.
                    </p>
                    <a href="{{ route('course.index') }}" target="_self" class="btn btn-primary">Ir para Cursos</a>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <img src="{{ asset('images/users.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Usuários</h5>
                    <p class="card-text">
                        Utilize o gerenciador de usuários para cadastrar novos usuários que poderão acessar este sistema para realizar tarefas de gerenciamento.
                    </p>
                    <a href="{{ route('user.index') }}" target="_self" class="btn btn-warning">Ir para Usuários</a>
                </div>
            </div>
        </div>
    </div>

@endsection
