@extends('layouts.app')

@section('content')

<div class='row'>
  <div class='col-md-4'>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">TODO List Title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
      <div class="card-body">
        <a 
        href="{{ route('list') }}" 
        class="card-link btn btn-outline-danger">View TODO List</a>
      </div>
  </div>


  </div>
</div>

@endsection