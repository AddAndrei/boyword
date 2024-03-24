<?php

namespace App\Http\Responses;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class PaginateCollection extends AnonymousResourceCollection
{
    /**
     * @param $request
     * @param $paginated
     * @param $default
     * @return mixed
     */
    public function paginationInformation($request, $paginated, $default): array
    {
        return Arr::only($paginated, ['total', 'per_page', 'last_page', 'from', 'to', 'current_page']);
    }
}
