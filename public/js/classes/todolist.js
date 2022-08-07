
// This class is responsible for Managin Todolists functionality
// like add, edit and delete

class Todolist {
    static remove(id) {
        let token = $("meta[name='csrf-token']").attr('content');
        let formData = new FormData();
        formData.append('id', id);
        formData.append('_token', token);
        Ajax.send('POST', `/api/todolists/${id}`, formData, (response) => {
            if( response.success )
            {
                $("#todolist-"+id).remove();
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