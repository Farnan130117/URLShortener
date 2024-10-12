<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class ShortUrl extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'long_url',
        'short_code',
        'expires_at',
    ];

    public function clicks()
    {
        return $this->hasMany(UrlClick::class);
    }

    public function isExpired()
    {
        // Check if the current date is greater than the expiration date
        return $this->expires_at && Carbon::now()->greaterThan($this->expires_at);
    }
}
