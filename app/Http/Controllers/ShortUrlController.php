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

    public function index()
    {
        // Get the initial 5 short URLs
        $shortUrls = ShortUrl::
            orderByDesc('id')
            ->take(5)
            ->get();
        // Get trending URLs
        $trendingUrls = ShortUrl::select(
            'short_urls.id',
            'short_urls.long_url',  // Specify the required columns
            'short_urls.short_code',  // Specify the required columns
            'short_urls.user_id',    // Include other columns as needed
            'short_urls.created_at',  // Add any additional required columns
            \DB::raw('COUNT(url_clicks.id) as click_count')
        )
            ->leftJoin('url_clicks', 'short_urls.id', '=', 'url_clicks.short_url_id')
            ->groupBy(
                'short_urls.id',
                'short_urls.long_url',
                'short_urls.short_code',
                'short_urls.user_id',
                'short_urls.created_at'  // Ensure all selected columns are here
            )
            ->havingRaw('COUNT(url_clicks.id) > 0') // Ensure only URLs with more than 0 clicks are retrieved
            ->orderByDesc('click_count')
            ->take(5) // Limit to top 5 trending URLs
            ->get();
       // dd($trendingUrls);


        return view('welcome', compact('shortUrls','trendingUrls'));
    }

    public function loadMoreUrls(Request $request)
    {
        $offset = $request->offset;
        $limit = 5;

        // Fetch the next set of short URLs
        $shortUrls = ShortUrl::skip($offset)
            ->orderByDesc('id')
            ->take($limit)
            ->get();

        return response()->json($shortUrls);
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
        $shortUrls = ShortUrl::where('user_id', Auth::user()->id)->orderByDesc('id')->get();
        //dd($shortUrls);
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
