@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Listagem dos cursos cadastrados')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Cancelar</a>
@endsection


@section('content')

    <p>
        EDIT
    </p>

@endsection
