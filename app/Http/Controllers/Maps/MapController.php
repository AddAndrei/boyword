<?php

namespace App\Http\Controllers\Maps;

use App\Http\Controllers\Controller;
use App\Http\DTO\Maps\CreateMapDTO;
use App\Http\DTO\Maps\UpdateMapDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\Maps\CreateRequest;
use App\Http\Requests\Maps\UpdateMapRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Maps\MapResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Map\Map;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends Controller
{
    private EntityMediatr $entityMediatr;

    public function __construct()
    {
        $this->entityMediatr = new EntityMediatr(new Map(), new Service());
    }

    #[Route('/api/maps', methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        $maps = $this->entityMediatr->all(null, function(Map $map){
            return $map::all();
        });
        return MapResponse::collection($maps);
    }
    #[Route('/api/maps', methods: ["POST"])]
    public function store(CreateRequest $request): MapResponse
    {
        $map = $this->entityMediatr->store(CreateMapDTO::createFromRequest($request));
        return MapResponse::make($map)->created();
    }
    #[Route('/api/maps/{id}', methods: ["GET"])]
    public function show(int $id): MapResponse
    {
        return MapResponse::make($this->entityMediatr->get('id', $id));
    }

    #[Route('/api/maps/{id}', methods: ["PATCH"])]
    public function update(UpdateMapRequest $request, int $id): MapResponse
    {
        $map = $this->entityMediatr->update($id, UpdateMapDTO::createFromRequest($request));
        return MapResponse::make($map);
    }

    #[Route('/api/maps', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->entityMediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }

}
