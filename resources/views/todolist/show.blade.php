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
                    <input type="text" class="form-control form-control-lg" id="new-task-input"
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
        let html = `<div class='row'>`;
        if( !response.todolist || response.todolist.tasks.length == 0 )
        {
          html += `<h4 class='text-center empty-list-notify'>There Are No Tasks In This Todolist.</h4>`;
        }
        else {
          response.todolist.tasks.forEach((task, index) => {
            html += `
              <ul id='task-${task.id}' class="list-group list-group-horizontal rounded-0 tasks">
                <li
                  class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                  <h4 class="lead fw-normal mb-0 d-block">${task.title}</h4>
                </li>
                
                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">

                  <div class="text-end">
                    
                      <a 
                      href="#" 
                      class="btn btn-primary btn-sm">EDIT</a>

                      <a 
                      href="#" 
                      class="btn btn-danger btn-sm">DELETE</a>

                  </div>
                </li>
              </ul>
            `;
          });
        }
        html += '</div>';
        $("#todolist").append(html);
      });

      
    });
</script>
@endsection