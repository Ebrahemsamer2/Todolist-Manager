<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap5.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">

        <title>TODO MANAGER</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <strong class='text-white h4'>TODO</strong> MANAGER</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userDropdown" aria-controls="userDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="userDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ \Route::currentRouteName() == 'home' ? 'active' : ''; }}" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a 
                        class="nav-link btn btn-danger btn-sm text-white todolistmodalopener" 
                        href="#" 
                        data-bs-toggle="modal" 
                        data-bs-target="#newtodolistmodal"><strong style='letter-spacing:1.5px;'>New TODO List</strong></a>
                    </li>

                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.tokens') }}">My Tokens</a>
                            </li>
                            <li><a 
                            onclick="event.preventDefault();document.querySelector('#logout-form').submit();"
                            class="dropdown-item" 
                            href="#">LOGOUT</a></li>
                            <form id='logout-form' method='POST' action="{{ route('logout') }}">@csrf</form>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        
        <div class='container my-5'>

            @yield('content')

        </div>

        <script src="{{ asset('js/bundle.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/classes/ajax.js') }}"></script>
        <script src="{{ asset('js/classes/todolist.js') }}"></script>
        <script src="{{ asset('js/classes/task.js') }}"></script>

        @yield('scripts')

        <script>
            // set modal to the default
            $(document).on("click", ".todolistmodalopener", (e) => {
                $("#newtodolistmodal input[name='title']").val('')
                $("#newtodolistmodal textarea[name='description']").val('');
                $("#newtodolistmodal .update-todolist-btn").addClass('create-todolist-btn');
                $("#newtodolistmodal .update-todolist-btn").removeClass('update-todolist-btn');
            });

            // remove backdrop in case user close modal in different ways.
            $(document).on('hidden.bs.modal', "#newtodolistmodal", function (e) {
                $('.modal-backdrop').remove();
            })

        </script>

        <!-- Modal -->
        @include('includes.todolistmodal')

    </body>
</html>