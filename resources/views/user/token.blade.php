@extends('layouts.app')

@section('content')

<div class='row'>

    <div class='table-responsive'>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Token</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $token->accessToken->name }}</td>
                    <td>{{ $token->plainTextToken }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection