<?php

namespace App\Http\Controllers\Task;

use App\Exceptions\Attachments\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\DTO\Tasks\CreateDTO;
use App\Http\Requests\PaginateWithFiltersRequest;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Responses\Task\TaskResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Tasks\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends Controller
{
    private EntityMediatr $mediatr;
    public function __construct(EntityMediatr $mediatr)
    {
        $this->mediatr = new EntityMediatr(new Task(), new Service());
    }
    /**
     * @throws UnknownProperties
     */
    #[Route('/api/tasks', methods: ["GET"])]
    public function index(PaginateWithFiltersRequest $request): AnonymousResourceCollection
    {
        $dto = PaginateWithFiltersDTO::createFromRequest($request);
        $tasks = $this->mediatr->all($dto, fn(Task $task) =>
            Task::with(['creator'])
                //->where('status', '!=', 'done')
                ->paginateWithFilters($dto));
        return TaskResponse::collection($tasks);
    }


    /**
     * @throws UnknownProperties
     */
    #[Route('/api/tasks', methods:["POST"])]
    public function store(CreateTaskRequest $request): TaskResponse
    {
        $dto = CreateDTO::createFromRequest($request);
        $task = $this->mediatr->store($dto, function(Task $task) use($dto) {
            $task->creator()->associate(Auth::user());
            return $task;
        });
        return TaskResponse::make($task)->created();
    }

    #[Route('/api/tasks/{id}', methods: ["GET"])]
    public function show(int $id): TaskResponse
    {
        $task = Task::with(['creator'])->where('id', $id)->first();
        return TaskResponse::make($task);
    }
}
