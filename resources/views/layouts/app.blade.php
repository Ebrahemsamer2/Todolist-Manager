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
                    class="nav-link btn btn-danger btn-sm text-white" 
                    href="#" 
                    data-bs-toggle="modal" 
                    data-bs-target="#newtodolistmodal"><strong style='letter-spacing:1.5px;'>New TODO List</strong></a>
                </li>

                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
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
    
    @yield('scripts')
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

        <!-- Modal -->
        <div class="modal fade" id="newtodolistmodal" tabindex="-1" aria-labelledby="newtodolistmodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Todo List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Title:</label>
                        <input placeholder="ex: Learning Data Structure" type="text" class="form-control" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea placeholder="ex: Leating Beginner Data Structure topics list stack, queues and LinkedList..." class="form-control" id="description"></textarea>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-sm">Create Todo List</button>
                </div>
                </div>
            </div>
        </div>

    </body>
</html>