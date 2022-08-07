<div class="modal fade" id="newtodolistmodal" tabindex="-1" aria-labelledby="newtodolistmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Todo List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <input name='id' type="hidden" id="id">
                <div class="mb-3">
                    <label for="title" class="col-form-label">Title:</label>
                    <input name='title' placeholder="ex: Learning Data Structure" type="text" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="description" class="col-form-label">Description:</label>
                    <textarea name='description' placeholder="ex: Learning Basic Data Structure topics list stack, queues and LinkedList..." class="form-control" id="description"></textarea>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button onclick="Todolist.save(event);" type="button" class="btn btn-danger btn-sm create-todolist-btn">Save Todo List</button>
            </div>
        </div>
    </div>
</div>