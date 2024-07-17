<div class="row" id="myreservations-data-result">
    @php
        $cnt = 0;
    @endphp
    @foreach ($reservations as $res)
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/rooms/'.$res->Rooms->picture) }}" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-8">
                        <h5 class="card-title">{{ $res->Rooms->room }}</h5>
                        <p class="card-text">{{ $res->Rooms->description }}</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Price: <span class='fw-bold text-primary'>₱ {{ number_format($res->Rooms->price, 2) }} per day</span></p>
                                <span class="card-title"><small class="text-muted"><i>Amount to be paid: </i></small>
                                    <span class="fw-bolder">₱ {{ number_format($res->total_payment, 2) }}</span>
                                </span>

                                <div class="fw-bold">
                                    <i class="fas fa-calendar-check text-success me-1"></i>
                                    {{ date('M d, Y', strtotime($res->checkin)) }} -
                                    {{ date('M d, Y', strtotime($res->checkout)) }} |
                                    {{ $res->days }} day/s
                                </div>
                            
                                    @if($res->status == 1)
                                        <p class="mt-2 text-sm text-danger">Pending</p>
                                    @endif
                                    @if($res->status == 2)
                                        <p class="mt-2 text-sm text-success">Reserved</p>
                                    @endif
                            </div>
                            <div class="col-md-6">
                                @if($res->status == 2)
                                <div class="mb-2">
                                    <p class="text-sm my-0">In: 
                                        @if($res->time_in != null)
                                            <span class="text-sm fw-bolder">{{ date('M d, Y | h:i A', strtotime($res->time_in)) }}</span>
                                        @else
                                            <span class="text-danger">--</span>
                                        @endif
                                    </p>
                                    <p class="text-sm my-0">Out: 
                                        @if($res->time_out != null)
                                            <span class="text-sm fw-bolder">{{ date('M d, Y | h:i A', strtotime($res->time_out)) }}</span>
                                        @else
                                            <span class="text-danger">--</span>
                                        @endif
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                            <hr>
                            @if($res->status == 2)
                                @if($res->payment_method == null)
                                <p class="text-sm mb-0">Pay Online (Optional)</p>
                                @else
                                <p class="text-sm mb-0 text-success">Paid! Please contact the resort to confirm your payment</p>
                                @endif
                            @endif
                            <div class="row">
                                <div class="col-md-8">
                                    @if($res->status == 2)
                                        @if($res->payment_method == null)
                                        <form action="" class="d-inline" id="pay-online">
                                            @csrf
                                            <input type="hidden" class="form-control" name="id" value="{{ $aes->encrypt($res->id) }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Payment Method</label>
                                                    <select name="payment_method" id="" class="form-select" required>
                                                        <option value="">Select...</option>
                                                        <option value="{{ $aes->encrypt('1') }}">GCash</option>
                                                        <option value="{{ $aes->encrypt('2') }}">PayMaya</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Account Number</label>
                                                    <input type="number" name="account_number" class="form-control" required>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm bg-gradient-success mt-3">Pay</button>
                                        </form>
                                        @else
                                            <a wire:navigate href=
                                            "
                                            @if($res->payment_method == 1)
                                                {{ route('gcash', ['id' => $aes->encrypt($res->id), 'key' => \Str::random(50)]) }}
                                            @endif
                                            @if($res->payment_method == 2)
                                                {{ route('paymaya', ['id' => $aes->encrypt($res->id), 'key' => \Str::random(50)]) }}
                                            @endif
                                            " class="text-sm text-dark text-decoration-underline">View Receipt</a>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    @if($res->status == 1 || $res->status == 2)
                                        <a href="#" id="cancel-reservation" class="btn btn-sm btn-danger float-end m-2" data-id="{{ $aes->encrypt($res->id) }}">Cancel</a>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $cnt = 1;
    @endphp
    @endforeach
    @if($cnt == 0)
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <p class="mt-3">No Data Found</p>
            </div>
        </div>
    </div>
    @endif
</div>