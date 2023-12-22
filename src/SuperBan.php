<?php

namespace Themitope\Superban;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;

final class SuperBan
{

    /**
     * Constructor Class
     */
    public function __construct(protected readonly RateLimiter $limiter)
    {
    }

    /**
     * Determine if the key has too many attempts
     */
    public function tooManyAttempts($key, $maxAttempts): bool
    {
        return $this->limiter->tooManyAttempts($key, $maxAttempts);
    }

    /**
     * Increment the counter for the key for the given decay time
     */
    public function hit(string $key, int $decaySeconds)
    {
        $this->limiter->hit($key, $decaySeconds);
    }

    /**
     * Clear the number of attempts
     */
    public function clear(string $key)
    {
        $this->limiter->clear($key);
    }

    /**
     * Ban client for a particular period of time
     */
    public function banClient(string $banKey, int $banDuration)
    {
        Cache::put($banKey, true, $banDuration);
    }

    /**
     * Check if client is banned
     */
    public function isBanned(string $banKey): bool
    {
        return Cache::has($banKey);
    }
}
