<x-guest-layout>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent text-start">
                                    <p class="fw-bolder">Malapascua Room Reservation</p>
                                    <h4 class="font-weight-black text-dark">Log In</h4>
                                    
                                </div>
                                <div class="text-center">
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @error('message')
                                        <div class="alert alert-danger text-sm" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger text-dark text-sm" id="error" style="display: none;"></div>
                                    <form class="text-start" action="" id="sign-in">
                                        @csrf
                                        <label>Email Address</label>
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email address"
                                                value="{{ old('email') ? old('email') :'' }}"
                                                aria-label="Email" aria-describedby="email-addon" required>
                                        </div>
                                        
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password"
                                                value="{{ old('password') ? old('password') : '' }}"
                                                class="form-control" placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon" required>
                                        </div>
                                
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Sign in</button>
                                        </div>
                                    </form>
                                    
                                    <div id="g_id_onload"
                                        data-client_id="{{ env('GOOGLE_CLIENT_ID') }}"
                                        data-callback="onSignIn">
                                    </div>
                                    <div class="g_id_signin form-control" data-type="standard"></div>
                                    
                                 <div id="loginmsg"></div>
                                 
                                 <script src="https://accounts.google.com/gsi/client" async defer></script>
                                 <script>
                                    function decodeJwtResponse(token) {
                                        let base64Url = token.split('.')[1];
                                        let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                                        let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                                            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                                        }).join(''));
                                        return JSON.parse(jsonPayload);
                                    }
                                
                                    window.onSignIn = googleUser => {
                                        var user = decodeJwtResponse(googleUser.credential);
                                
                                        if (user) {
                                            $.ajax({
                                                url: '/sign-in-with-google',
                                                method: 'POST',
                                                data: { 
                                                    name: user.name,
                                                    email: user.email 
                                                },
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                beforeSend:function(){
                                                    SweetAlert.fire({
                                                        position: 'center',
                                                        icon: 'info',
                                                        title: 'Verifying Google Account...',
                                                        allowOutsideClick: true,
                                                        showConfirmButton: false
                                                    });
                                                },
                                                success: function(response) {
                                                    if (response.error == true) {
                                                        Swal.close();
                                                        $("#error").show(50);
                                                        $("#error").text(response.Message);
                                                    } else {
                                                        window.location.href="/";
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error:', error);
                                                }
                                            });
                                        } else {
                                            $("#loginmsg").html("<div class='alert alert-danger'>You have no institutional account registered.</div>");
                                        }
                                    }
                                </script>
                                
                                
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Don't have an account?
                                        <a wire:navigate href="{{ route('sign-up') }}" class="text-dark font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="background-image:url('/storage/images/2247297d178479a3004b27ed1c0ded4d.webp')">
                                    <div
                                        class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h2 class="mt-3 text-dark font-weight-bold">Malapascua Island Cebu</h2>
                                        <h6 class="text-dark text-sm mt-5">Explore Cebu's Malapascua Island, known for being a diving destination where you can swim with thresher sharks, making it one of the top Visayas tourist spots</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>
