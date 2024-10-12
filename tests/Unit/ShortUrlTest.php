<?php

namespace Tests\Unit;

use App\Models\ShortUrl;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase; // This trait will roll back the database after each test

    protected $user;

    protected function setUp(): void
    {
        parent::setUp(); // Call the parent setup

        // Create a user to be used in the tests
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'), // Use a hashed password
        ]);
    }

    /** @test */
    public function it_creates_a_short_url()
    {
        // Arrange: Set up data for the test
        $data = [
            'user_id' => $this->user->id, // Use the created user's ID
            'long_url' => 'https://www.example.com',
            'short_code' => 'abc123',
            'expires_at' => null,
        ];

        // Act: Create a new ShortUrl instance
        $shortUrl = ShortUrl::create($data);

        // Assert: Check if the short URL was created
        $this->assertDatabaseHas('short_urls', [
            'long_url' => 'https://www.example.com',
            'short_code' => 'abc123',
        ]);

        $this->assertEquals($data['user_id'], $shortUrl->user_id);
    }

    /** @test */
    public function it_requires_a_long_url()
    {
        // Arrange: Set up data with missing long_url
        $data = [
            'user_id' => $this->user->id, // Use the created user's ID
            'short_code' => 'abc123',
            'expires_at' => null,
        ];

        // Act & Assert: Expect a validation exception
        $this->expectException(\Illuminate\Database\QueryException::class);
        ShortUrl::create($data);
    }

    /** @test */
    public function it_requires_a_unique_short_code()
    {
        // Arrange: Create a short URL
        ShortUrl::create([
            'user_id' => $this->user->id, // Use the created user's ID
            'long_url' => 'https://www.example.com',
            'short_code' => 'abc123',
            'expires_at' => null,
        ]);

        // Act & Assert: Expect a validation exception for duplicate short_code
        $this->expectException(\Illuminate\Database\QueryException::class);
        ShortUrl::create([
            'user_id' => $this->user->id, // Use the created user's ID
            'long_url' => 'https://www.test.com',
            'short_code' => 'abc123',
            'expires_at' => null,
        ]);
    }

    /** @test */
    public function it_can_expire_short_url()
    {
        // Arrange: Create a short URL with an expiration date
        $shortUrl = ShortUrl::create([
            'user_id' => $this->user->id, // Use the created user's ID
            'long_url' => 'https://www.example.com',
            'short_code' => 'abc123',
            'expires_at' => now()->addDays(1), // expires in 1 day
        ]);

        // Act: Expire the short URL
        $shortUrl->expires_at = now()->subDay();
        $shortUrl->save();

        // Assert: Check if it has expired
        $this->assertTrue($shortUrl->isExpired());
    }

}
