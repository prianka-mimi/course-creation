<nav class="sb-topnav navbar navbar-expand navbar-dark align-items-center">
    <a class="text-black navbar-brand ps-3 text-white" href="{{ route('dashboard') }}"><strong>Course Creation</strong></a>
    <button class="order-1 btn btn-outline-success btn-sm order-lg-0 me-1 ms-4" id="sidebarToggle">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>

    <!-- Navbar-->
    <div class="row align-items-center d-lg-flex d-done" style="width: calc(100% - 150px)">
        <div class="col-lg-5">
        </div>
        <div class="col-lg-3">

        </div>
        <div class="col-lg-4 text-end">
            <p class="me-4"><strong>{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong></p>
        </div>
    </div>
    <ul class="navbar-nav ms-auto ms-md-auto me-3 me-lg-4" style="width: 75px">
        <li class="nav-item dropdown">
            <a class="dropdown-toggle text-theme" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw "></i></a>
            <ul class="text-center dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Profile</a></li>
                <li><a class="dropdown-item" href="#!">Change Password</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                class="fa-solid fa-power-off"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
