<?php

namespace Themitope\Superban\Tests;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Themitope\Superban\SuperBan;

class SuperBanTest extends TestCase
{
    /**
     * assert that a client is banned after a period of time
     */
    public function test_user_is_banned()
    {
        // Assuming you have an instance of SuperBanRateLimiter
        $superBanRateLimiter = new SuperBan((new RateLimiter));

        // A sample user ID
        $userId = 1;

        // Check if the ban status is stored in the cache
        $banKey = "superban:ban:{$userId}";

        // Call the banUser method
        $superBanRateLimiter->banClient($banKey, 30);

        // Assert that the cache has the ban status
        $this->assertTrue(Cache::has($banKey));

        // Optionally, you can assert the ban duration if needed
        // $this->assertEquals(config('superban.ban_duration'), Cache::getStore()->getMetadata($banKey)['expire']);
    }
}
