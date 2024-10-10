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
    <form method="POST" action="{{ route('shorten') }}">
        @csrf
        <input type="url" name="long_url" required placeholder="Enter URL">


        <label for="expire_at">Expiration Date (optional):</label>
        <input type="date" name="expire_at" id="expire_at">

        <button type="submit">Shorten</button>


        @if ($errors->has('error'))
            <span class="text-danger">{{ $errors->first('error') }}</span>
        @endif


        @error('long_url')
        <span class="text-danger">{{ $message }}</span>
        @enderror


        @error('expire_at')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </form>

@endsection
