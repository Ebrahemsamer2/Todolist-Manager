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
                      <button onclick="Task.addTaskIn('{{ $id }}')"type="button" class="btn btn-primary create-new-task">Add</button>
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
      let todolist_id = "{{ $id }}";
      Task.loadTasks( todolist_id );
    });
</script>
@endsection