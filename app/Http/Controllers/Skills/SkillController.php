<?php

namespace App\Http\Controllers\Skills;

use App\Http\Controllers\Controller;
use App\Http\DTO\Skills\CreateSkillDTO;
use App\Http\DTO\Skills\UpdateSkillDTO;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\Skills\CreateSkillRequest;
use App\Http\Requests\Skills\UpdateSkillRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Skills\SkillResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Skills\Skill;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends Controller
{
    private EntityMediatr $mediatr;

    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Skill(), new Service());
    }

    #[Route('/api/skill', methods: ["POST"])]
    public function store(CreateSkillRequest $request): SkillResponse
    {
        return SkillResponse::make($this->mediatr->store(CreateSkillDTO::createFromRequest($request)))
            ->created();
    }

    #[Route('/api/skill', methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        return SkillResponse::collection(
            $this->mediatr->all(null, function (Skill $skill) {
                return $skill::with('image')->get();
            })
        );
    }
    #[Route('/api/skill/{id}')]
    public function show(int $id): SkillResponse
    {
        return SkillResponse::make(
            $this->mediatr->get('id', $id)
        );
    }

    #[Route('/api/skill/{id}', methods: ["PUT"])]
    public function update(UpdateSkillRequest $request, int $id): SkillResponse
    {
        $dto = UpdateSkillDTO::createFromRequest($request);
        $updated = $this->mediatr->update(
            $id,
            $dto,
            function (Skill $skill) use($dto) {
                return $skill->checkValues($dto, [
                    'level',
                    'experience',
                    'attack_speed',
                    'damage',
                ]);
            }
        );
        return SkillResponse::make($updated);
    }

    #[Route('/api/skill', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $this->mediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }

}
