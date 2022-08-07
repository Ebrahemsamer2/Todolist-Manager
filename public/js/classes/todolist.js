
// This class is responsible for Managin Todolists functionality
// like add, edit and delete

class Todolist {
    static save(event) {
        if( $(event.target).hasClass("create-todolist-btn") )
            this.create();
        else 
            this.update();
    }

    static update() {
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
                
                Ajax.showMessage('Todolist has been updated.', 1);
            }
        }); 
    }


    static create() {
        let title = $("#newtodolistmodal input[name='title']").val();
        let description = $("#newtodolistmodal textarea[name='description']").val();
        let token = $("meta[name='csrf-token']").attr('content');
        
        let formData = new FormData();
        formData.append('title', title);
        formData.append('description', description);
        formData.append('_token', token);
        
        Ajax.send('POST', "/api/todolists", formData, (response) => {
            let todolist = response.todolist;
            let todolist_route = "/list/"+ todolist.id;
            let html = `
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
            $(".empty-list-notify").remove();
            
            $("#todolists .row").prepend(html);

            // clear modal data and hide it.
            $("#newtodolistmodal input, #newtodolistmodal textarea").val('');
            $("#newtodolistmodal").hide();
            $("#newtodolistmodal").removeClass("show");
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            Ajax.showMessage('Todolist has been created.', 1);
        });
    }

    static loadTodolists()
    {
        Ajax.send('GET', "/api/todolists", "", (response) => {
            $(".loader").remove();
            let html = `<div class='row'>`;
            if( response.todolists.length == 0 )
            {
              html += `<h4 class='text-center empty-list-notify'>There Are No Todolists For Now.</h4>`;
            }
            else {
              response.todolists.forEach((todolist, index) => {
                let todolist_route = "/list/" + todolist.id;
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
              }
              html += '</div>';
              $("#todolists").append(html);
        });
    }

    static remove(id) {
        let token = $("meta[name='csrf-token']").attr('content');
        let formData = new FormData();
        formData.append('id', id);
        formData.append('_token', token);
        Ajax.send('POST', `/api/todolists/${id}`, formData, (response) => {
            if( response.success )
            {
                $("#todolist-"+id).parent().remove();
                Ajax.showMessage('Todolist has been deleted.', 1);
            }
        });
    }

    static edit(id) {
        Ajax.send('GET', `/api/todolists/${id}`, "", (response) => {
            if(response) {
                // $("#newtodolistmodal").modal('show');
                let myModal = new bootstrap.Modal(document.getElementById('newtodolistmodal'), {
                    keyboard: false
                })
                
                let modalToggle = document.getElementById('newtodolistmodal') // relatedTarget
                myModal.show(modalToggle)

                $("#newtodolistmodal input[name='id']").val(response.todolist.id);
                $("#newtodolistmodal input[name='title']").val(response.todolist.title);
                $("#newtodolistmodal textarea[name='description']").val(response.todolist.description);
                $("#newtodolistmodal button.create-todolist-btn").addClass('update-todolist-btn');
                $("#newtodolistmodal button.create-todolist-btn").removeClass('create-todolist-btn');
            }
        });
    }
}