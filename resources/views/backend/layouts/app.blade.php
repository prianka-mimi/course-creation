<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layouts.partials.head')
    <title>{{ $cms_content['page_title'] ?? 'Dashboard' }} - {{ env('APP_NAME') }}</title>
</head>

<body class="sb-nav-fixed">
    @include('backend.layouts.partials.nav')
    <div id="layoutSidenav">
        @include('backend.layouts.partials.side-bar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @include('backend.layouts.partials.breadcrumb')
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @include('backend.layouts.partials.scripts')
</body>

</html>
