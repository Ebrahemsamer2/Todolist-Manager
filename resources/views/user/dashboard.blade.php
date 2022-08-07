@extends('layouts.app')

@section('content')
<div class='row'>

    @if( \Session::has('message') )
        <div class="alert alert-success" role="alert">
            {{ \Session::get('message') }}
        </div>
    @endif
    
    <form class='d-block' method='POST' action='{{ route("user.tokens.store") }}'>
        @csrf
        <div class='row'>
            <div class='col-md-8'>
                <input required type='text' class='form-control' name='token_name' placeholder='Token Name'>
            </div>
            <div class='col-md-4'>
                <input type='submit' class='form-control btn btn-primary' value='Create Token'>
            </div>
        </div>
    </form>
</div>

<div class='row'>

    <div class='table-responsive'>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Last Used At</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tokens as $key => $token)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $token->name }}</td>
                    <td>{{$token->last_used_at ? $token->last_used_at->diffForHumans() : ''}}</td>
                    <td>
                        <a 
                        onclick="event.preventDefault();document.querySelector('#delete-token-form').submit();"
                        class='btn btn-danger btn-sm'
                        href='#'>Delete</a>
                    </td>

                    <form id='delete-token-form' method='POST' action="{{ route('user.tokens.delete', $token->id) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
                @empty
                    <p class='text-center m-4 lead'>There're no tokens created.</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection