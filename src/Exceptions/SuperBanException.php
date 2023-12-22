<?php

namespace Themitope\Superban\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SuperBanException extends Exception
{
   /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return Response::HTTP_TOO_MANY_REQUESTS;
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::error($this->getMessage());
    }

    /**
     * Render
     */
    public function render()
    {
        return response()->json(["error" => true, "message" => $this->getMessage()], $this->getCode());
    }
}
