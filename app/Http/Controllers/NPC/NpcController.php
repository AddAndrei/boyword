<?php

namespace App\Http\Controllers\NPC;

use App\Http\Controllers\Controller;
use App\Http\DTO\NPC\CreateOrUpdateNpcDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\NPC\CreateNpcRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\NPC\NPCResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Npc\Npc;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\Routing\Annotation\Route;

class NpcController extends Controller
{
    private EntityMediatr $mediatr;

    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Npc(), new Service());
    }

    #[Route('/api/npc', methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        $npcs = $this->mediatr->all(null, function (Npc $npc) {
            return $npc::all();
        });
        return NPCResponse::collection($npcs);
    }

    #[Route('/api/npc', methods: ["POST"])]
    public function store(CreateNpcRequest $request): NPCResponse
    {
        return NPCResponse::make(
            $this->mediatr->store(CreateOrUpdateNpcDTO::createFromRequest($request))
        )->created();
    }

    #[Route('/api/npc/{id}', methods: ["PATCH"])]
    public function update(CreateNpcRequest $request, int $id): NPCResponse
    {
        $updated = $this->mediatr->update($id, CreateOrUpdateNpcDTO::createFromRequest($request));
        return NPCResponse::make($updated);
    }

    #[Route('/api/npc/{id}', methods: ["GET"])]
    public function show(int $id): NPCResponse
    {
        return NPCResponse::make($this->mediatr->get('id', $id));
    }

    #[Route('/api/npc', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->mediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
