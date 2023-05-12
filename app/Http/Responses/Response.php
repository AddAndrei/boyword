<?php

namespace App\Http\Responses;

use App\Http\Extensions\ResourceAsResponseTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class Response extends JsonResource
{
    use ResourceAsResponseTrait;

    public static $wrap = '';
}
