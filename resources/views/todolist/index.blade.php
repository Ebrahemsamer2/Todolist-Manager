@extends('layouts.app')

@section('content')
<div id='todolists'>

  <div class="d-flex justify-content-center loader">
    <div style="width:8rem;height:8rem;" class="spinner-grow text-dark" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

</div>

@endsection

@section('scripts')

<script>
    $(function() {
        let formData = new FormData();
        
        Ajax.send('GET', "{{ route('todolists.index') }}", formData, (response) => {
            $(".loader").remove();

            let html = `<div class='row'>`;
            response.todolists.forEach((todolist, index) => {
              let todolist_route = "{{ route('list', ':id') }}";
              todolist_route = todolist_route.replace(':id', todolist.id);
              html += `
                <div class='col-md-4'>
                  <div class='todolist'>
                    <div class="card">
                      <div class="card-body todolist-info">
                        <h5 class="card-title">${todolist.title}</h5>
                        <p class="card-text">${todolist.description}</p>
                      </div>
                      <div class="card-body">
                        <a 
                        href="${todolist_route}" 
                        class="card-link btn btn-outline-danger">View TODO List</a>
                      </div>
                    </div>
                  </div>
                </div>
                `;
              });
              html += '</div>';
              $("#todolists").append(html);
        });
    })
</script>

@endsection