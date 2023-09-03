<?php

namespace App\Http\Controllers\Tiles;

use App\Http\Controllers\Controller;
use App\Http\DTO\Tiles\CreateTileDTO;
use App\Http\DTO\Tiles\UpdateTileDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\Tiles\CreateTileRequest;
use App\Http\Requests\Tiles\UpdateTileRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Tiles\TileResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Tiles\Tile;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\Routing\Annotation\Route;

class TileController extends Controller
{
    private EntityMediatr $entityMediatr;

    public function __construct()
    {
        $this->entityMediatr = new EntityMediatr(new Tile(), new Service());
    }

    #[Route('/api/tile', methods: ["POST"])]
    public function store(CreateTileRequest $request): TileResponse
    {
        $tile = $this->entityMediatr->store(CreateTileDTO::createFromRequest($request));
        return TileResponse::make($tile)->created();
    }

    #[Route("/api/tile", methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        $tiles = $this->entityMediatr->all(null, function (Tile $tile){
            return $tile::with('image')->get();
        });
        return TileResponse::collection($tiles);
    }

    #[Route('/api/tile/{id}', methods: ["PATCH"])]
    public function update(UpdateTileRequest $request, int $id): TileResponse
    {
        $tile = $this->entityMediatr->update($id, UpdateTileDTO::createFromRequest($request));
        return TileResponse::make($tile);
    }

    #[Route('/api/tile/{id}', methods: ["GET"])]
    public function show(int $id): TileResponse
    {
        return TileResponse::make($this->entityMediatr->get('id', $id));
    }

    #[Route('/api/tile', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->entityMediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }

}
