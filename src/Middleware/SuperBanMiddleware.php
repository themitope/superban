<?php

namespace Themitope\Superban\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Themitope\Superban\Exceptions\SuperBanException;
use Themitope\Superban\SuperBan;

class SuperBanMiddleware
{

    public function __construct(protected readonly SuperBan $limiter)
    {
    }

    public function handle(Request $request, Closure $next, int $noOfRequests, int $timeFrame, int $banMinutes)
    {
        $userId = auth()->id();
        $userEmail = auth()->user()->email ?? null;
        $ip = $request->ip();

        //if user is authenticated, key will be either user id or user email, if not then key will be ip address of user
        $key = $userId ?? $userEmail ?? $ip;

        //convert time frame to seconds
        $decayMinutes = $timeFrame * 60;

        //convert ban duration to seconds
        $banDuration = $banMinutes * 60;

        $banKey = "superban:ban:{$key}";

        if ($this->limiter->isBanned($key)) {
            throw new SuperBanException("You are banned", Response::HTTP_FORBIDDEN);
        }

        if ($this->limiter->tooManyAttempts($key, $noOfRequests)) {
            $this->limiter->banClient($banKey, $banDuration);
            throw new SuperBanException("Too many requests");
        }

        $this->limiter->hit($key, $decayMinutes);

        return $next($request);
    }

}
