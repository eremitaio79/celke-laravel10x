<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    {{-- Bootstrap is now included by Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <link href="{{ asset('css/bootstrap533/bootstrap.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/fontawesome671/all.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/sweetalert2_11.14.5/sweetalert2.min.css') }}" rel="stylesheet"> --}}
</head>

<body>

    <div class="container-fluid sticky-top" style="background-color:#2b3035">
        {{-- CONTAINER START --}}
        <div class="container">
            {{-- NAVBAR START --}}
            <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}" target="_self">COURSES</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('home') }}"
                                    target="_self">Home</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Módulos
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('course.index') }}" target="_self">
                                        <i class="fa-solid fa-book"></i>&nbsp;&nbsp;Lista de Cursos...</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('allclasse.index') }}" target="_self">
                                        <i class="fa-solid fa-clipboard"></i>&nbsp;&nbsp;Todas as Aulas...</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('user.index') }}" target="_self"><i
                                                class="fa-solid fa-user"></i>&nbsp;&nbsp;Usuários...</a></li>
                                </ul>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('logout.process') }}"
                                    target="_self">Encerrar</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#"
                                        target="_self">
                                        @if (auth()->check())
                                            <i class="fa-solid fa-user"></i>&nbsp;
                                            <strong>{{ auth()->user()->name }}</strong>&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-envelope"></i>
                                            &nbsp;{{ auth()->user()->email }}
                                        @endif
                                    </a>
                                </li>
                            </ul>
                            {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button> --}}
                        </form>
                    </div>
                </div>
            </nav>
            {{-- NAVBAR END --}}
        </div>
        {{-- CONTAINER END --}}
    </div>


    {{-- CONTENT START --}}
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_self"
                                class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-none"><i
                                    class="fa-solid fa-house"></i></a>
                        </li>
                        @yield('bc1')
                        @yield('bc2')
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">

                {{-- CARD START --}}
                <div class="card text-center">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8 text-start">
                                <h3>@yield('title_card')</h3>
                            </div>

                            <div class="col-4 text-end">
                                @yield('links')
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @yield('content')
                    </div>
                    <div class="card-footer text-body-secondary">
                        @yield('footer_card')
                    </div>
                </div>
                {{-- CARD END --}}

            </div>
        </div>
    </div>
    {{-- CONTENT END --}}


    {{-- <script src="{{ asset('js/bootstrap533/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/bootstrap533/tooltips.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/fontawesome671/all.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/sweetalert2_11.14.5/sweetalert2@11.js') }}"></script> --}}

</body>

</html>
