
// This class is responsible for Managin Tasks functionality
// like add, edit and delete

class Task {
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