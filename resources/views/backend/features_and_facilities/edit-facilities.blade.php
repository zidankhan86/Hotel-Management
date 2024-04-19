<!-- Edit Facility Modal -->
<div class="modal fade" id="editModal{{$facility->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Facility</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('facilities.update', $facility->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit-recipient-name" class="col-form-label">Facility Name</label>
                            <input type="text" class="form-control" id="edit-recipient-name" name="name" value="{{$facility->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="edit-message-text" class="col-form-label">Description</label>
                            <textarea class="form-control" id="edit-message-text" name="description">{{$facility->description}}</textarea>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var recipient = button.getAttribute('data-bs-whatever');
        var modalTitle = editModal.querySelector('.modal-title');
        var modalBodyInput = editModal.querySelector('.modal-body input');
        modalTitle.textContent = 'Edit Facilities';
    });
    </script>
    