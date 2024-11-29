@extends('layout.template1')

{{-- SECTIONS --}}
@section('title', 'CURSOS')
@section('title_card', 'Listagem dos cursos cadastrados')
@section('footer_card', '...')


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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
            {{-- TABLE END --}}

        </div>
    </div>


@endsection
