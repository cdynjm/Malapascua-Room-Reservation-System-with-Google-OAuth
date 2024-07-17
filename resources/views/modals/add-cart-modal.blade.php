<div class="modal fade" id="createCartModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-radius-md">
            <div class="modal-header">
                <h5 class="modal-title">Process Reservation Transaction</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                    <form action="" id="checkin-room" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <p>Reservation Details</p>

                                <input type="hidden" name="id" id="reserve-id" class="form-control" readonly>

                                <label for="">Room Name</label>
                                <input type="text" name="room" id="reserve-room" class="form-control" readonly>
                            
                                <label for="">Price per day</label>
                                <input type="number" name="price" id="reserve-price" class="form-control" readonly>

                                <label for="">Check In Date</label>
                                <input type="date" name="checkin" id="checkin" class="form-control" min="{{ date('Y-m-d') }}" required>

                                <label for="">Check Out Date</label>
                                <input type="date" name="checkout" id="checkout" class="form-control" min="{{ date('Y-m-d') }}" required>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Number of Days</label>
                                        <input type="number" name="days" id="days" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Total Payment</label>
                                        <input type="number" name="total_payment" id="total-payment" class="form-control" readonly>        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-sm bg-dark text-white">Confirm Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
