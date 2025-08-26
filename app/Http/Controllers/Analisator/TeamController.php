<?php

namespace App\Http\Controllers\Analisator;

use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Responses\Analizator\PlayerResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Analisator\Player;
use App\Models\Analisator\Team;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeamController extends Controller
{

    private EntityMediatr $mediatr;

    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Team(), new Service());
    }

    public function index(PaginateWithFiltersRequest $request)
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $teams = $this->mediatr->all($dto, function (Team $team) use ($dto) {
            return $team::with([])->paginateWithFilters($dto);
        });
    }

    public function show(int $id)
    {

    }

    public function update(int $id)
    {

    }

    public function store()
    {

    }

    public function get(FormRequest $request): AnonymousResourceCollection
    {
        $team = $request->get('team');
        $players = Player::where('nick', 'like', "%$team%")->get();
        return PlayerResponse::collection($players);
    }
}
