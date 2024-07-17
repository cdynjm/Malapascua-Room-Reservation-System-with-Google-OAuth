@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

@extends('modals.add-cart-modal')
<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('components.app.navbar', ['title' => 'Dashboard'])
        <div class="container-fluid py-4 px-5">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="search-room" placeholder="Search...">
                    </div>
                    <div class="col-md-8"></div>
                </div>
                @include('data.dashboard-data')
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
