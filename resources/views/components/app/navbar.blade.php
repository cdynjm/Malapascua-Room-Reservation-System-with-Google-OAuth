<nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $title }}</li>
            </ol>
            <h6 class="font-weight-bold mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                
            </div>
            <div class="mb-0 font-weight-bold breadcrumb-text text-white">
                <form id="sign-out">
                    @csrf
                    <button class="ms-2 nav-link text-dark font-weight-bold p-0 border-0 bg-white">
                        <i class="fas fa-sign-out-alt me-2"></i> Log Out
                    </button>
                </form>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-dark"></i>
                            <i class="sidenav-toggler-line bg-dark"></i>
                            <i class="sidenav-toggler-line bg-dark"></i>
                        </div>
                    </a>
                </li>
                <p class="mt-3 mx-2 text-sm">{{ Auth::user()->name }}</p>
                <li class="nav-item ps-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <img src="/assets/computer.png" class="avatar avatar-sm" alt="avatar" />
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
