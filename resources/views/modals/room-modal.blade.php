<div class="modal fade" id="createRoomModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-radius-md">
            <div class="modal-header">
                <h5 class="modal-title">New Room</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    <form action="" id="create-room" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <p>Room Information</p>

                                <label for="">Room Name</label>
                                <input type="text" name="room" class="form-control" required>

                                <label for="">Room Description</label>
                                <textarea name="description" id="" cols="30" rows="5" class="form-control" required></textarea>
                            
                                <label for="">Price</label>
                                <input type="number" name="price" class="form-control" required>

                                <label for="">Maximum Guest</label>
                                <input type="number" name="maxguest" class="form-control">

                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-sm bg-dark text-white">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
