@php
    use Illuminate\Support\Str;
    $isAdminRoute = Str::startsWith(Route::currentRouteName(), 'admin.');
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">
                {{ $isAdminRoute ? 'Dashboard' : 'Home' }}
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        @auth
            <li class="nav-item">
                <a class="nav-link" href="#" role="button">
                    {{ Auth::user()->name }}
                </a>
            </li>
        @endauth
    </ul>
</nav>
