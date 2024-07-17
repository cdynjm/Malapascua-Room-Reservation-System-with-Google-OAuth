<div class="row" id="pending-reservations-data-result">
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

                            @if($res->status == 1)
                                <a href="#" id="approved-reservation" class="btn btn-sm btn-success float-end m-2" data-id="{{ $aes->encrypt($res->id) }}">Reserve</a>
                                <a href="#" id="cancel-reservation" class="btn btn-sm btn-danger float-end m-2" data-id="{{ $aes->encrypt($res->id) }}">Cancel</a>
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