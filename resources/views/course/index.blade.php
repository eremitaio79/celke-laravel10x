@extends('layout.template1')

{{-- SECTIONS --}}
@section('title', 'CURSOS')
@section('title_card', 'Listagem dos cursos cadastrados')
@section('footer_card', '...')

@section('links')
    <a href="{{ route('course.create') }}" target="_self" class="btn btn-primary">Novo</a>
@endsection


{{-- CONTENT --}}
@section('content')

    <div class="row">
        <div class="col-12 mb-3">

            {{-- TABLE START --}}
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>
                            <a href="{{ route('course.edit') }}">Edit</a>&nbsp;|&nbsp;
                            <a href="{{ route('course.show') }}">Show</a>
                            {{-- <a href="{{ route('course.delete') }}">Delete</a> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- TABLE END --}}

        </div>
    </div>


@endsection
