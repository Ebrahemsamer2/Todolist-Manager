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
    $(function() {
        Ajax.send('GET', "{{ route('todolists.index') }}", "", (response) => {
            $(".loader").remove();

            let html = `<div class='row'>`;
            response.todolists.forEach((todolist, index) => {
              let todolist_route = "{{ route('list', ':id') }}";
              todolist_route = todolist_route.replace(':id', todolist.id);

              html += `
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
              });
              html += '</div>';
              $("#todolists").append(html);
        });

        $(document).on("click", ".update-todolist-btn", (e) => {
          let title = $("#newtodolistmodal input[name='title']").val();
          let description = $("#newtodolistmodal textarea[name='description']").val();
          let token = $("meta[name='csrf-token']").attr('content');
          let id = $("#newtodolistmodal input[name='id']").val();
          
          let formData = new FormData();
          formData.append('title', title);
          formData.append('description', description);
          formData.append('_token', token);
          formData.append('_method', 'PUT');

          Ajax.send('POST', `/api/todolists/${id}`, formData, (response) => {
            let todolist = response.todolist;
            if( todolist )
            {
              $("#todolist-"+todolist.id+ " .todolist-info .title").text( todolist.title );
              $("#todolist-"+todolist.id+ " .todolist-info .description").text( todolist.description );

              // clear modal data and hide it.
              $("#newtodolistmodal input, #newtodolistmodal textarea").val('');
              $("#newtodolistmodal").hide();
              $("#newtodolistmodal").removeClass("show");
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
            }
          }); 
        }); 
    });
</script>

@endsection