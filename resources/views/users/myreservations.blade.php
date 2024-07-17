@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\AESCipher;
    $aes = new AESCipher();
@endphp

<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('components.app.navbar', ['title' => 'My Reservations'])
        <div class="container-fluid py-4 px-5">
            @include('data.myreservations-data')
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
