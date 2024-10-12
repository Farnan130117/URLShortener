<!-- resources/views/layouts/partials/footer.blade.php -->
<footer>
    <section class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 mx-auto text-center">
                    <div class="footer-logo">
{{--                        <img src="{{ asset('frontend/images/logo.svg') }}" alt="logo" />--}}
                        <a class="navbar-brand" href="{{ route('home') }}" style="color: black;">
                            <b>SHORTLY</b>
                            {{--                <img class="logo-main" src="{{ asset('frontend/images/logo.svg') }}" alt="logo" />--}}
                        </a>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="footer-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="sociale-icon">
                        <ul>
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
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="copy-right">
                        <p>© Copyright <span id="copyrightYear"></span> - All Rights Reserved by <a href="https://staticmania.com/" target="_blank">StaticMania</a> Distributed By <a href="https://themewagon.com/" target="blank">ThemeWagon</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</footer>
