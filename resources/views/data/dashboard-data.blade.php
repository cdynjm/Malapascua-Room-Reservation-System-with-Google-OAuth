<div class="row" id="dashboard-data-result">
    @php
        $search = false;
    @endphp
    @foreach ($rooms as $ro)
        <div class="col-md-4 mb-4">
            <div class="card" style="height: 96%;">

                <img src="{{ asset('storage/rooms/'.$ro->picture) }}" class="card-img-top" alt="...">
                <div class="card-body p-4">
                    <h6 class="get-room card-title">{{ $ro->room }}</h6>
                    <p class="get-description card-text text-xs">{{ $ro->description }}</p>
                    <hr>
                    <input type="hidden" class="get-price" value="{{ $ro->price }}">
                    <h5 class="card-text fw-bold d-inline">₱ {{ number_format($ro->price, 2) }} <span class="fs-6 opacity-7"> per day</span></h5>
                    <div class="float-end">Max Guest: <span class="get-guest fs-5 fw-bold">{{ $ro->maxguest }}</span></div>
                    @foreach ($ro->reservation->where('status', '!=', 3) as $reservation)
                        <div class="text-xs text-danger">
                            Reserved: {{ date('M d, Y', strtotime($reservation->checkin)) }} - {{ date('M d, Y', strtotime($reservation->checkout)) }}
                        </div>
                    @endforeach
                    <div class="mt-3">
                        <a id="add-to-cart" href="#" class="btn btn-sm btn-success me-1" data-room-id="{{ $aes->encrypt($ro->id) }}"><i class="fas fa-cart-plus text-sm me-1"></i> Add</a>
                    </div>
                    
                </div>
            </div>
        </div>
        @php
            $search = true
        @endphp
    @endforeach
    @if($search == false)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    No Data Found
                </div>
            </div>
        </div>
    @endif
</div>