<div class="row" id="approved-reservations-data-result">
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
                        <p class="fw-bolder mb-1">{{ $res->User->name }}</p>
                        <p class="fw-normal my-0 text-xs">{{ $res->User->location }}</p>
                        <p class="fw-bolder my-0">{{ $res->User->phone }}</p>
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
                                <div>
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
                                    @if($res->time_in == null)
                                    <button class="btn btn-sm btn-info" id="check-in-time" data-id="{{ $aes->encrypt($res->id)}}">Check In</button>
                                    @endif
                                    @if($res->time_out == null && $res->time_in != null)
                                    <button class="btn btn-sm btn-info" id="check-out-time" data-id="{{ $aes->encrypt($res->id)}}">Check Out</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                           
                            <hr>
                            @if($res->payment_method != null)
                                <p class="text-sm mb-0 text-success">Paid Online! Please check your account to confirm the payment</p>

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

                            @if($res->status == 2)
                                @if($res->time_in != null && $res->time_out != null)
                                <a href="#" id="finish-reservation" class="btn btn-sm btn-success float-end m-2" data-id="{{ $aes->encrypt($res->id)}}">Done</a>
                                @endif
                            @endif
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