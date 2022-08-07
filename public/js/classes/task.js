
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
            }
        });
    }
}