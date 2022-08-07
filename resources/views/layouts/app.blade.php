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

            // Create a new Todolist
            $(document).on("click", ".create-todolist-btn", (e) => {
                
                let title = $("#newtodolistmodal input[name='title']").val();
                let description = $("#newtodolistmodal textarea[name='description']").val();
                let token = $("meta[name='csrf-token']").attr('content');
                
                let formData = new FormData();
                formData.append('title', title);
                formData.append('description', description);
                formData.append('_token', token);
                
                Ajax.send('POST', "{{ route('todolists.store') }}", formData, (response) => {
                    let todolist = response.todolist;
                    let todolist_route = "{{ route('list', ':id') }}";
                    todolist_route = todolist_route.replace(':id', todolist.id);
                    let html = `
                        <div class='col-md-4'>
                            <div id='todolist-${todolist.id}' class='todolist mb-4'>
                                <div class="card">
                                    <div class="card-body todolist-info">
                                        <h5 class="card-title title">${todolist.title}</h5>
                                        <p class="card-text description">${todolist.description}</p>
                                    </div>
                                    <div class="card-body">
                                        <a 
                                        href="${todolist_route}" 
                                        class="card-link btn btn-outline-secondary btn-sm">View</a>
                                        <a 
                                        onclick="event.preventDefault();Todolist.edit('${todolist.id}');"
                                        href="#" 
                                        class="card-link btn btn-outline-primary btn-sm">Edit</a>
                                        <a 
                                        onclick="event.preventDefault();Todolist.remove('${todolist.id}');"
                                        href="#" 
                                        class="card-link btn btn-outline-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $(".empty-list-notify").remove();
                    
                    $("#todolists .row").append(html);

                    // clear modal data and hide it.
                    $("#newtodolistmodal input, #newtodolistmodal textarea").val('');
                    $("#newtodolistmodal").hide();
                    $("#newtodolistmodal").removeClass("show");
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                });
            })
        </script>

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
                        <input name='id' type="hidden" id="id">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title:</label>
                            <input name='title' placeholder="ex: Learning Data Structure" type="text" class="form-control" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea name='description' placeholder="ex: Leating Beginner Data Structure topics list stack, queues and LinkedList..." class="form-control" id="description"></textarea>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-sm create-todolist-btn">Save Todo List</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>