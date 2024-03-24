<?php

namespace App\Http\Controllers\Quests;

use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\DTO\Quests\CreateQuestDTO;
use App\Http\DTO\Quests\UpdateQuestDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Requests\Quests\CreateQuestRequest;
use App\Http\Requests\Quests\UpdateQuestRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Quest\QuestResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Quests\QuestService;
use App\Http\Services\Service;
use App\Models\Quests\Quest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\Routing\Annotation\Route;

class QuestController extends Controller
{
    private EntityMediatr $mediatr;
    private QuestService $questService;

    public function __construct(QuestService $service)
    {
        $this->mediatr = new EntityMediatr(new Quest(), new Service());
        $this->questService = $service;
    }

    #[Route('/api/quest', methods: ["POST"])]
    public function store(CreateQuestRequest $request): QuestResponse
    {
        $dto = CreateQuestDTO::createFromRequest($request);
        $quest = $this->mediatr->store(
            $dto,
            fn(Quest $quest) => $this->questService->businessProcess($quest, $dto)
        );
        return QuestResponse::make($quest)->created();
    }

    #[Route('/api/quest/{id}', methods: ["PATCH", "PUT"])]
    public function update(UpdateQuestRequest $request, int $id): QuestResponse
    {
        $dto = UpdateQuestDTO::createFromRequest($request);
        $quest = $this->mediatr->update(
            $id,
            $dto,
            fn(Quest $quest) => $this->questService->businessProcess($quest, $dto)
        );
        return QuestResponse::make($quest);
    }
    #[Route('/api/quest', methods:["GET"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $quests = $this->mediatr->all(closure:
            fn(Quest $quest) => $quest::with(['npc', 'parent', 'condition.resource'])
                                    ->paginateWithFilters($dto));
        return QuestResponse::collection($quests);

    }

    #[Route('/api/quest/{id}', methods: ["GET"])]
    public function show(int $id): QuestResponse
    {
        $quest = Quest::with(['npc', 'parent', 'condition.resource'])
            ->where('id', $id)
            ->firstOrFail();
        return QuestResponse::make($quest);
    }

    #[Route('/api/quest', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->mediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
