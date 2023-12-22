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
        $superBanRateLimiter = new SuperBan((new RateLimiter));
        $userId = 1;

        $banKey = "superban:ban:{$userId}";
        $superBanRateLimiter->banClient($banKey, 30);

        $this->assertTrue(Cache::has($banKey));

        // $this->assertEquals(config('superban.ban_duration'), Cache::getStore()->getMetadata($banKey)['expire']);
    }
}
