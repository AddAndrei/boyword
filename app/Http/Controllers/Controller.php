<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Mediatr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as SymphonyResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonException(Exception $exception, int $statusCode = SymphonyResponse::HTTP_UNPROCESSABLE_ENTITY): Application|ResponseFactory|Response
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
