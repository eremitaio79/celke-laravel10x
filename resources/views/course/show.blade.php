@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Detalhes do curso selecionado')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Voltar</a>
@endsection


@section('content')

    <p>
        Course SHOW...
    </p>

@endsection
