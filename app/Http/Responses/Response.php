<?php

namespace App\Http\Responses;

use App\Http\Extensions\ResourceAsResponseTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class Response extends JsonResource
{
    use ResourceAsResponseTrait;
    public static $wrap = '';

    /**
     * Create a new anonymous resource collection.
     *
     * @param  mixed  $resource
     * @return PaginateCollection
     */
    public static function collection($resource): PaginateCollection
    {
        return tap(new PaginateCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }
}
