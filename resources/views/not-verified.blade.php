<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('components.app.navbar', ['title' => 'Email Verification'])
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="text-center text-danger">
                    You are not validated. Please check your email to authenticate your account before proceeding.                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

</x-app-layout>