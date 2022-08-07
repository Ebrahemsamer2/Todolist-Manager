@extends('layouts.app')

@section('content')

<div class='row'>
    
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
          <div class="card-body px-md-5">
            
            <h3 class='text-center todolist-title'></h3>
              
            <div class="pb-2">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row align-items-center">
                    <input required type="text" class="form-control form-control-lg" id="new-task-input"
                      placeholder="Add New Task">
                    <a href="#!" data-mdb-toggle="tooltip" title="Set due date"><i
                        class="fas fa-calendar-alt fa-lg me-3"></i></a>
                    <div>
                      <button type="button" class="btn btn-primary create-new-task">Add</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4">
            
            <div id='todolist'>

              <div class="d-flex justify-content-center loader">
                <div style="width:8rem;height:8rem;" class="spinner-border m-5 text-dark" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>

            </div>
            
          </div>
        </div>
      </div>
</div>

@endsection

@section('scripts')

<script>
    $(function() {
      let id = "{{ $id }}";
      
      Ajax.send('GET', `{{ route('todolists.show', "${id}") }}` , "", (response) => {
        $(".loader").remove();
        $(".todolist-title").text( response.todolist.title );
        let html = ``;
        if( !response.todolist || response.todolist.tasks.length == 0 )
        {
          html += `<h4 class='text-center empty-tasks-notify'>There Are No Tasks In This Todolist.</h4>`;
        }
        else {
          response.todolist.tasks.forEach((task, index) => {
            html += `
              <ul id='task-${task.id}' class="list-group list-group-horizontal rounded-0 tasks">
                <li
                  class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                  <h4 class="lead fw-normal mb-0 d-block task-title">${task.title}</h4>
                  <input 
                    onfocus="let value = this.value; this.value = null; this.value=value"
                    onfocusout="Task.update('${response.todolist.id}', '${task.id}')"
                    type='text' 
                    name='task-title'
                    class='form-control d-none' 
                    value='${task.title}' 
                    disabled>
                </li>
                
                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">

                  <div class="text-end">
                    
                      <a 
                      onclick="event.preventDefault(); Task.edit('${task.id}')"
                      href="#" 
                      class="btn btn-primary btn-sm edit-btn">EDIT</a>

                      <a 
                      onclick="event.preventDefault();Task.remove('${response.todolist.id}', '${task.id}');"
                      href="#" 
                      class="btn btn-danger btn-sm delete-btn">DELETE</a>

                  </div>
                </li>
              </ul>
            `;
          });
        }
        $("#todolist").append(html);
      });

      $(document).on("click", ".create-new-task", (e) => {
        let title = $("#new-task-input").val();
        let token = $("meta[name='csrf-token']").attr('content');

        let formData = new FormData();
        formData.append('todolist_id', id);
        formData.append('title', title);
        formData.append('_token', token); 

        Ajax.send('POST', `/api/list/${id}/tasks`, formData, (response) => {
          if( response.task )
          {
            let html = `
              <ul id='task-${response.task.id}' class="list-group list-group-horizontal rounded-0 tasks">
                <li
                  class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                  <h4 class="lead fw-normal mb-0 d-block task-title">${response.task.title}</h4>
                  <input 
                    onfocus="let value = this.value; this.value = null; this.value=value"
                    onfocusout="Task.update('${id}', '${response.task.id}')"
                    type='text' 
                    name='task-title'
                    class='form-control d-none' 
                    value='${response.task.title}' 
                    disabled>
                </li>
                
                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">

                  <div class="text-end">
                    
                      <a 
                      onclick="event.preventDefault(); Task.edit('${response.task.id}')"
                      href="#" 
                      class="btn btn-primary btn-sm">EDIT</a>

                      <a 
                      onclick="event.preventDefault();Task.remove('${id}', '${response.task.id}');"
                      href="#" 
                      class="btn btn-danger btn-sm">DELETE</a>

                  </div>
                </li>
              </ul>
            `;
            $(".empty-tasks-notify").remove();
            $("#todolist").append(html);
            $("#new-task-input").val('');
          }
        });
      });
    });
</script>
@endsection