@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('components.app.navbar', ['title' => 'Dashboard'])
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card p-2">
                        <div class="card-body">
                          <h6 class="card-title fs-6">Rooms <span class="text-sm opacity-7">| Total</span></h6>
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-house-user fs-3 text-info"></i>
                            </div>
                            <div class="ps-3 ms-2">
                              <h4>{{ $rooms }}</h4>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card p-2">
                        <div class="card-body">
                          <h6 class="card-title fs-6">Pending <span class="text-sm opacity-7">| Reservations</span></h6>
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-minus-circle fs-3 text-danger"></i>
                            </div>
                            <div class="ps-3 ms-2">
                              <h4>{{ $pending }}</h4>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card p-2">
                        <div class="card-body">
                          <h6 class="card-title fs-6">Approved <span class="text-sm opacity-7">| Reservations</span></h6>
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-check-circle fs-3 text-success"></i>
                            </div>
                            <div class="ps-3 ms-2">
                              <h4>{{ $approved }}</h4>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>

            </div>
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
