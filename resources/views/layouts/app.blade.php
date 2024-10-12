<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, Nofollow, Noimageindex">
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>@yield('title')</title>
    <!-- Include your CSS files -->
{{--    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.svg') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset('frontend/images/favicon.svg') }}" type="image/x-icon" />
</head>
<body>
<!-- Header -->
@include('layouts.partials.header')

<!-- Main Content -->
<div class="content">
    @yield('content')
</div>

<!-- Footer -->
@include('layouts.partials.footer')

<!-- Include your JS files -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<!-- Google Map -->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9rV6yesIygoVKTD6QLf_iCa9eiIIHqZ0&libraries=geometry"></script>--}}
<!-- Vendor JS -->
<script src="{{ asset('frontend/vendor/jQuery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/g-map/gmap.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('frontend/js/script.js') }}"></script>
</body>
</html>
