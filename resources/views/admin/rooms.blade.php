@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

@extends('modals.room-modal')
@extends('modals.edit.edit-room-modal')
<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('components.app.navbar', ['title' => 'Rooms'])
        <div class="container-fluid py-4 px-5">
            @include('data.rooms-data')
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
