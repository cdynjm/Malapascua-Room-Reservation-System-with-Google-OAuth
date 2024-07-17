<div class="modal fade" id="editRoomModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-radius-md">
            <div class="modal-header">
                <h5 class="modal-title">Update Room</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    <form action="" id="update-room" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <p>Room Information</p>

                                <input type="hidden" id="edit-room-id" name="id" value="">

                                <label for="">Room Name</label>
                                <input type="text" name="room" id="edit-room-name" class="form-control" required>

                                <label for="">Room Description</label>
                                <textarea name="description" id="edit-description" cols="30" rows="5" class="form-control" required></textarea>
                            
                                <label for="">Price</label>
                                <input type="number" name="price" id="edit-price" class="form-control" required>

                                <label for="">Maximum Guest</label>
                                <input type="number" name="maxguest" id="edit-maxguest" class="form-control">

                                <label for="">Upload New Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-sm bg-dark text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
