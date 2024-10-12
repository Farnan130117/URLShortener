<!-- resources/views/layouts/partials/header.blade.php -->
<header>
{{--    <nav>--}}
{{--        <ul>--}}
{{--            <li><a href="{{ route('dashboard') }}">Home</a></li>--}}
{{--            <li><a href="{{ route('login') }}">Login</a></li>--}}
{{--            <li><a href="{{ route('register') }}">Register</a></li>--}}
{{--        </ul>--}}
{{--    </nav>--}}

<!-- Navbar Start -->
    <nav class="main-nav navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="logo-main" src="{{ asset('frontend/images/logo.svg') }}" alt="logo" />
            </a>
            <!-- Toogle Button -->
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#mainNav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse nav-list" id="mainNav">
                <!-- Navigation Links -->
                <ul class="navbar-nav ml-auto">
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                </ul>
                <!-- Social Link -->
                <ul class="main-nav-social">
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

</header>
