<?php

namespace App\Http\Responses\Add;

use App\Http\Responses\Response;
use App\Models\Adds\Favorite;

class FavoriteAddsResponse extends Response
{
    /**
     * @param $request
     * @return AddResponse
     */
    public function toArray($request): AddResponse
    {
        /** @var Favorite $this */
        return AddResponse::make($this->add);
    }
}
