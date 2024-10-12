<h1>Dashboard</h1>

@if($shortUrls->isNotEmpty())
    @foreach($shortUrls as $url)
        <div>
            <a href="{{ route('redirect', $url->short_code) }}">{{ $url->short_code }}</a> - {{ $url->long_url }}
        </div>
    @endforeach
@else
    <p>No URLs found.</p>
@endif

<form method="POST" action="{{ route('shorten') }}">
    @csrf
    <input type="url" name="long_url" required placeholder="Enter URL">
    <button type="submit">Shorten</button>
    <!-- Error display for long_url -->
    @error('long_url')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</form>
