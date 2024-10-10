<?php
namespace App\Services;

use App\Models\ShortUrl;
use App\Models\UrlClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UrlShortenerService
{
    public function createShortUrl($userId, $longUrl, $expireAt = null)
    {
        // Check if the user has created more than 10 URLs today
        if (!$this->userCanCreateUrl($userId)) {
        return false;
        }
        // Get expiration date from the form
        $expireAt = $expireAt;
        // Generate a unique short code
        $shortCode = Str::random(6);

        // Create the Short URL in the database
        return ShortUrl::create([
        'user_id' => $userId,
        'long_url' => $longUrl,
        'short_code' => $shortCode,
        'expire_at' => $expireAt,
        ]);
    }

    public function userCanCreateUrl($userId)
    {
        $todayCount = ShortUrl::where('user_id', $userId)
        ->whereDate('created_at', now()->toDateString())
        ->count();

        return $todayCount < 10;  // Limit user to 10 URLs per day
    }

    public function getOriginalUrl($shortCode)
    {
        $url = ShortUrl::where('short_code', $shortCode)->first();
            if ($url) {
                // Record the click details
                $this->recordClick($shortCode);

                //return redirect($shortUrl->long_url);
            }
        return $url ? $url->long_url : null;
    }
    public function recordClick(string $shortCode)
    {

        $shortUrl = ShortUrl::where('short_code', $shortCode)->firstOrFail();
        $ip = request()->ip();
        $location = $this->getLocation($ip);
        //dd($location);
        UrlClick::create([
            'short_url_id' => $shortUrl->id,
            'ip_address'   => $ip,
            'location'     => $location,
            'clicked_at'   => now(),
        ]);
    }

    public function getPublicIp()
    {
        try {
            $response = Http::get('https://api.ipify.org?format=json');
            $data = $response->json();

            if (isset($data['ip'])) {
                return $data['ip'];
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getLocation($ip)
    {
        try {

            if ($ip === '127.0.0.1' || $ip === '::1') {
                $ip = $this->getPublicIp(); // Get public IP when working on localhost
            }

            if ($ip) {

                $response = Http::get("http://ip-api.com/json/{$ip}");
                $data = $response->json();
               // dd($data);


                if ($data && $data['status'] === 'success') {
                   // return $data['city'] . ', ' . $data['country'];
                    return  $data['country'];
                }
            }

            // Handle failure or unknown IP cases
            return 'Unknown Location';
        } catch (\Exception $e) {
            // Handle errors, such as network issues
            return 'Error: Unable to determine location';
        }
    }

}

