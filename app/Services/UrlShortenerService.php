<?php
namespace App\Services;

use App\Models\ShortUrl;
use Illuminate\Support\Str;

class UrlShortenerService
{
    public function createShortUrl($userId, $longUrl)
    {
    // Check if the user has created more than 10 URLs today
    if (!$this->userCanCreateUrl($userId)) {
    return false;
    }

    // Generate a unique short code
    $shortCode = Str::random(6);

    // Create the Short URL in the database
    return ShortUrl::create([
    'user_id' => $userId,
    'long_url' => $longUrl,
    'short_code' => $shortCode,
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
    return $url ? $url->long_url : null;
    }
}
