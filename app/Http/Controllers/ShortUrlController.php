<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Http\Requests\StoreShortUrlRequest;
use App\Http\Requests\UpdateShortUrlRequest;
use App\Models\UrlClick;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShortUrlController extends Controller
{
    protected $urlShortener;

    public function __construct(UrlShortenerService $urlShortener)
    {
        $this->urlShortener = $urlShortener;
    }

//    public function create(Request $request)
//    {
//        $request->validate([
//            'long_url' => 'required|url|unique:short_urls,long_url',
//            'expires_at' => 'nullable|date|after_or_equal:today',
//        ]);
//
//        if (!$this->urlShortener->userCanCreateUrl(Auth::id())) {
//            return back()->withErrors(['error' => 'URL limit reached for today']);
//        }
//
//        $shortUrl = $this->urlShortener->createShortUrl(Auth::id(), $request->long_url, $request->expires_at);
//
//        return redirect()->route('dashboard')->with('success', 'Short URL created: ' . $shortUrl->short_code);
//    }

    public function create(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url|unique:short_urls,long_url',
            'expires_at' => 'nullable|date|after_or_equal:today',
        ]);

        if (!$this->urlShortener->userCanCreateUrl(Auth::id())) {
            return response()->json(['error' => 'URL limit reached for today'], 403);
        }

        $shortUrl = $this->urlShortener->createShortUrl(Auth::id(), $request->long_url, $request->expires_at);

        // Return JSON response if request is via AJAX
        if ($request->ajax()) {
            return response()->json([
                'id' => $shortUrl->id,
                'long_url' => $shortUrl->long_url,
                'short_url' => route('redirect', $shortUrl->short_code), // Full URL
                'short_code' => $shortUrl->short_code,
                'created_at' => $shortUrl->created_at->format('Y-m-d'),
                'expires_at' => $shortUrl->expires_at ? $shortUrl->expires_at->format('Y-m-d') : null,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Short URL created: ' . $shortUrl->short_code);
    }


    public function redirect($shortCode)
    {
        $longUrl = $this->urlShortener->getOriginalUrl($shortCode);

        if ($longUrl) {
            return redirect($longUrl);
        }

        return abort(404);
    }

    public function dashboard()
    {
//      $shortUrls = Auth::user()->shortUrls;
        $shortUrls = ShortUrl::where('user_id', Auth::user()->id)->get();
        return view('admin.dashboard', compact('shortUrls'));
    }

    public function getUrlAnalytics($id)
    {
        // Find the short URL
        $shortUrl = ShortUrl::findOrFail($id);

        // Get the analytics data (clicks)
        $analytics = UrlClick::where('short_url_id', $id)->get();

        // Return the analytics data as JSON
        return response()->json([
            'analytics' => $analytics
        ]);
    }


}
