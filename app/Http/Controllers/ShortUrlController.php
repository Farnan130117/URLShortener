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

    public function create(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url|unique:short_urls,long_url',
            'expire_at' => 'nullable|date|after_or_equal:today',
        ]);

        if (!$this->urlShortener->userCanCreateUrl(Auth::id())) {
            return back()->withErrors(['error' => 'URL limit reached for today']);
        }

        $shortUrl = $this->urlShortener->createShortUrl(Auth::id(), $request->long_url, $request->expire_at);

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

}
