@extends('layouts.app')

@section('content')

<div class='row'>
    
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
          <div class="card-body px-md-5">
            
            <h3 class='text-center'>TODO List Title</h3>
              
            <div class="pb-2">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row align-items-center">
                    <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1"
                      placeholder="Add new...">
                    <a href="#!" data-mdb-toggle="tooltip" title="Set due date"><i
                        class="fas fa-calendar-alt fa-lg me-3"></i></a>
                    <div>
                      <button type="button" class="btn btn-primary">Add</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4">
            
            <ul class="list-group list-group-horizontal rounded-0">
              <li
                class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                <div class="form-check">
                  <input class="form-check-input me-0" type="checkbox" value="" id="flexCheckChecked2"
                    aria-label="..." />
                </div>
              </li>
              <li
                class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                <p class="lead fw-normal mb-0">Renew car insurance</p>
              </li>
              
              <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">

                <div class="text-end">
                  
                    <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                    <a href="#" class="btn btn-danger btn-sm">DELETE</a>

                </div>
              </li>
            </ul>
            
          </div>
        </div>
      </div>
</div>

@endsection