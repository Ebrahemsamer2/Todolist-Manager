
// This class is responsible for Managin Tasks functionality
// like add, edit and delete

class Task {
    static loadTasks(id)
    {
        Ajax.send('GET', `/api/todolists/${id}` , "", (response) => {
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
    }

    static remove(todolist_id, id) {
        let token = $("meta[name='csrf-token']").attr('content');
        let formData = new FormData();
        formData.append('task', id);
        formData.append('todolist', todolist_id);
        formData.append('_token', token);
        formData.append('_method', 'DELETE');
        Ajax.send('POST', `/api/list/${todolist_id}/tasks/${id}`, formData, (response) => {
            if( response.success )
            {
                $("#task-"+id).remove();

                Ajax.showMessage('Task has been deleted.', 1);
            }
        });
    }

    static edit(id) {
        $("#task-"+id).find(".task-title").addClass('d-none')
        $("#task-"+id).find(".task-title").next('input').prop('disabled', false);
        $("#task-"+id).find(".task-title").next('input').removeClass('d-none');
        $("#task-"+id).find(".task-title").next('input').focus();
    }

    static update(todolist_id, id) {
        let title = $("#task-"+id).find("input[name='task-title']").val();
        let token = $("meta[name='csrf-token']").attr('content');

        let formData = new FormData();
        formData.append('task', id);
        formData.append('title', title);
        formData.append('_token', token);
        formData.append('_method', 'PUT');

        Ajax.send('POST', `/api/list/${todolist_id}/tasks/${id}`, formData, (response) => {
            if( response.success )
            {
                $("#task-" + id).find(".task-title").text(title)
                $("#task-" + id).find(".task-title").removeClass('d-none')
                $("#task-" + id).find("input[name='task-title']").addClass('d-none')
                $("#task-" + id).find("input[name='task-title']").attr('disabled', true)

                Ajax.showMessage('Task has been updated.', 1);
            }
        });
    }

    static addTaskIn( todolist_id ) {
        let title = $("#new-task-input").val();
        let token = $("meta[name='csrf-token']").attr('content');

        let formData = new FormData();
        formData.append('todolist_id', todolist_id);
        formData.append('title', title);
        formData.append('_token', token); 

        Ajax.send('POST', `/api/list/${todolist_id}/tasks`, formData, (response) => {
            
            if( response.task )
            {
                let html = `
                    <ul id='task-${response.task.id}' class="list-group list-group-horizontal rounded-0 tasks">
                    <li
                        class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                        <h4 class="lead fw-normal mb-0 d-block task-title">${response.task.title}</h4>
                        <input 
                        onfocus="let value = this.value; this.value = null; this.value=value"
                        onfocusout="Task.update('${todolist_id}', '${response.task.id}')"
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
                            onclick="event.preventDefault();Task.remove('${todolist_id}', '${response.task.id}');"
                            href="#" 
                            class="btn btn-danger btn-sm">DELETE</a>

                        </div>
                    </li>
                    </ul>
                `;
                $(".empty-tasks-notify").remove();
                $("#todolist").append(html);
                $("#new-task-input").val('');

                Ajax.showMessage('Task has been created.', 1);
            }
        });
    }
}