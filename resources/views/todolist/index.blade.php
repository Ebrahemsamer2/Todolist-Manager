@extends('layouts.app')

@section('content')
<div id='todolists'>

  <div class="d-flex justify-content-center loader">
    <div style="width:8rem;height:8rem;" class="spinner-border m-5 text-dark" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

</div>

@endsection

@section('scripts')

<script>
    $(window).on('load', function() {
        Todolist.loadTodolists();
    });
</script>

@endsection