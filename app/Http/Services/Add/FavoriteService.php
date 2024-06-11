<?php

namespace App\Http\Services\Add;

use App\Http\Responses\OkResponse;
use App\Http\Responses\StringResponses\AddFavoriteExistsResponse;
use App\Http\Responses\StringResponses\FavoriteNotExistsResponse;
use App\Http\Responses\StringResponses\RemoveFavoriteResponse;
use App\Http\Responses\StringResponses\SuccessAddFavoriteResponse;
use App\Models\Adds\Add;
use App\Models\Adds\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    public static function add(int $id): SuccessAddFavoriteResponse|AddFavoriteExistsResponse
    {
        if(Favorite::where([['favoriteable_id', $id], ['user_id', Auth::id()]])->exists())
        {
            return AddFavoriteExistsResponse::make([]);
        }else{
            $add = Add::find($id);
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $add->favorites()->save($favorite);
            return SuccessAddFavoriteResponse::make([])->created();
        }
    }

    public static function remove(int $id): RemoveFavoriteResponse|FavoriteNotExistsResponse
    {
        if(Favorite::where([['favoriteable_id', $id], ['user_id', Auth::id()]])->exists())
        {
            $favorite = Favorite::where([['favoriteable_id', $id], ['user_id', Auth::id()]])->first();
            $add = Add::find($id);
            $add->favorites()->delete($favorite);
            return RemoveFavoriteResponse::make([]);
        }else{
           return FavoriteNotExistsResponse::make([]);
        }
    }
}
