@extends('layout.template1')

@section('title', 'CURSOS')
@section('title_card', 'Detalhes do curso selecionado')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.index') }}" target="_self" class="btn btn-secondary">Voltar</a>
@endsection


@section('content')

    <table class="table">
        <thead class="text-start">
            <tr>
                <th scope="col" style="width: 12%;">Campo</th>
                <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody class="text-start">
            <tr>
                <th scope="row">ID</th>
                <td>{{ $selectedCourse->id }}</td>
            </tr>
            <tr>
                <th scope="row">Curso</th>
                <td><strong>{{ $selectedCourse->name }}</strong></td>
            </tr>
            <tr>
                <th scope="row">Descrição</th>
                <td>{{ $selectedCourse->description }}</td>
            </tr>
            <tr>
                <th scope="row">Imagem</th>
                <td>{{ $selectedCourse->image }}</td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td>
                    @if ($selectedCourse->status == 1)
                        <h5><span class="badge text-bg-success">Ativo</span></h5>
                    @else
                        <h5><span class="badge text-bg-danger">Inativo</span></h5>
                    @endif

                </td>
            </tr>
            <tr>
                <th scope="row">Criação</th>
                <td>{{ \Carbon\Carbon::parse($selectedCourse->created_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}
                </td>
            </tr>
            <tr>
                <th scope="row">Atualização</th>
                <td>{{ \Carbon\Carbon::parse($selectedCourse->updated_at)->tz('America/Belem')->format('d/m/Y H:i:s') }}
                </td>
            </tr>
        </tbody>
    </table>

@endsection
