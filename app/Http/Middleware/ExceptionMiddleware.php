<?php

namespace App\Http\Middleware;


use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\Middleware;
use Closure;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as SymphonyResponse;

class ExceptionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        }catch (Exception $e){
            return $this->jsonException($e);
        }
    }

    private function jsonException(Exception $exception, int $statusCode = SymphonyResponse::HTTP_UNPROCESSABLE_ENTITY): Application|ResponseFactory|Response
    {
        Log::error(implode("\n", [
            "{$exception->getMessage()} In {$exception->getFile()} on line {$exception->getLine()}",
            $exception->getTraceAsString(),
        ]));
        return response([
            'title' => 'Ошибка обработки',
            'message' => $exception->getMessage(),
            'trace' => "In {$exception->getFile()} on line {$exception->getLine()}",
        ], $statusCode);
    }
}
