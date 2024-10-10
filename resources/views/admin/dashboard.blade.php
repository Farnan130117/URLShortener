<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Admin Dashboard</h1>

    <!-- Success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table to display short URLs -->
    <table>
        <thead>
        <tr>
            <th>Short URL</th>
            <th>Long URL</th>
            <th>Clicks</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shortUrls as $url)
            <tr>
                <td>{{ url('/' . $url->short_code) }}</td>
                <td>{{ $url->long_url }}</td>
                <td>{{ $url->clicks_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
