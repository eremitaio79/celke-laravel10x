@extends('layout.template1')


@section('title', 'USUÁRIOS')
@section('title_card', 'Cadastro de Novo Usuário')
@section('footer_card', '...')

{{-- Breadcrumb START --}}
@section('bc1')
<li class="breadcrumb-item active" aria-current="page"><strong>Usuários</strong></li>
@endsection
{{-- Breadcrumb END --}}


@section('links')
    <a href="{{ route('user.create') }}" target="_self" class="btn btn-primary">Novo Usuário</a>
@endsection


@section('content')

@endsection
