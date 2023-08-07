<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralJsonException extends Exception
{
    protected $code = 422;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return (new JsonResource([
            'errors' => [
                'message' => $this->getMessage(),
                'file' => $this->getFile(),
                'line' => $this->getLine(),
            ],
        ]))->response()->setStatusCode($this->code);
    }


}
