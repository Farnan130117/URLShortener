<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlClick extends Model
{
    use HasFactory;
    protected $fillable = [
        'short_url_id',
        'clicked_at',
        'ip_address',
        'location',
    ];

    // Define a relationship with ShortUrl
    public function shortUrl()
    {
        return $this->belongsTo(ShortUrl::class);
    }
}
