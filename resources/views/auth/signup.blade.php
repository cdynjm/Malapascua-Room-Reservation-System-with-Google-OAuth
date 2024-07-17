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
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 start-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute d-flex fixed-top ms-auto h-100 z-index-0 bg-cover me-n8"
                                    style="background-image:url('/storage/images/Malapascua_(island),_Tropical_lagoon,_Pure_tropical_bliss,_Philippines.jpg')">
                                    <div class="my-auto text-start max-width-350 ms-7">
                                        <h1 class="mt-3 text-white font-weight-bolder">Start your <br> new journey.</h1>
                                        <p class="text-white text-lg mt-4 mb-8">Explore Cebu's Malapascua Island, known for being a diving destination where you can swim with thresher sharks, making it one of the top Visayas tourist spots</p>
                                       
                                    </div>
                                    <div class="text-start position-absolute fixed-bottom ms-7">
                                        <h6 class="text-white text-sm mb-5">Find out about the best time to visit, how to go, where to stay, other top attractions, and local food you shouldn't miss in this guide.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-7">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h4 class="font-weight-black text-dark">Sign up</h4>
                                    <p class="mb-0">Nice to meet you! Please enter your details.</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="sign-up">
                                        @csrf
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Enter your name" value="{{old("name")}}" aria-label="Name"
                                                aria-describedby="name-addon" required>
                                            @error('name')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Contact Number</label>
                                        <div class="mb-3">
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                placeholder="Enter your phone number" value="{{old("phone")}}" aria-label="Phone"
                                                required>
                                        </div>
                                        <label>Address</label>
                                        <div class="mb-3">
                                            <input type="text" id="address" name="address" class="form-control"
                                                placeholder="Enter your address" value="{{old("address")}}" aria-label="Address"
                                                required>
                                        </div>
                                        <label>Email Address</label>
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email address" value="{{old("email")}}" aria-label="Email"
                                                aria-describedby="email-addon" required>
                                            @error('email')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Create a password" aria-label="Password"
                                                aria-describedby="password-addon" required>
                                            @error('password')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-check form-check-info text-left mb-0">
                                            <input class="form-check-input" type="checkbox" name="terms"
                                                id="terms" required>
                                            <label class="font-weight-normal text-dark mb-0" for="terms">
                                                I agree the <a href="javascript:;"
                                                    class="text-dark font-weight-bold">Terms and Conditions</a>.
                                            </label>
                                            @error('terms')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Sign up</button>
                                            
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Already have an account?
                                        <a wire:navigate href="{{ route('sign-in') }}" class="text-dark font-weight-bold">Sign
                                            in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>
