<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion theme-gradient-sidebar" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-4">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link" href="{{ route('category.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                    Category
                </a>

                <a class="nav-link" href="{{ route('course.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
                    Course
                </a>

                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                    User
                </a>
            </div>
    </nav>
</div>
