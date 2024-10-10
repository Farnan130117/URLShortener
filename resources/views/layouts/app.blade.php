<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include your CSS files -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
