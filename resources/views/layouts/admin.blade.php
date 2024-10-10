<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-container">
    <!-- Sidebar -->
@include('layouts.partials.admin-sidebar')

<!-- Main Content -->
    <div class="admin-content">
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
