<div class="row" id="rooms-data-result">
    <div class="col-md-12 mb-2">
        <button class="btn btn-sm btn-primary" id="add-room">+ Add Room</button>
    </div>
    @php
        $cnt = 0;
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
                    
                    <div class="mt-3">
                        <a id="edit-room" href="#" class="btn btn-sm btn-success me-1" data-room-id="{{ $aes->encrypt($ro->id) }}"><i class="fas fa-pen-fancy text-sm"></i></a>
                        <a class="btn btn-sm btn-danger" id="delete-room" data-room-id="{{ $aes->encrypt($ro->id) }}"><i class="fas fa-trash text-sm"></i></i></a>
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