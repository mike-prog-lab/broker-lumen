<?php


namespace App\Http\Controllers\Project\Task;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectTask\ProjectTaskCreateRequest;
use App\Http\Requests\ProjectTask\ProjectTaskUpdateRequest;
use App\Services\ProjectService;
use App\Services\ProjectTaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ProjectTaskController
 * @package App\Http\Controllers\ProjectTask
 */
class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskService
     */
    protected ProjectTaskService $projectTaskService;
    /**
     * @var ProjectService
     */
    protected ProjectService $projectService;

    /**
     * ProjectController constructor.
     * @param ProjectTaskService $projectTaskService
     * @param ProjectService $projectService
     */
    public function __construct(ProjectTaskService $projectTaskService, ProjectService $projectService)
    {
        $this->projectTaskService = $projectTaskService;
        $this->projectService = $projectService;
    }

    /**
     * @param int $projectId
     * @param int $id
     * @return JsonResponse
     */
    public function index(int $projectId, int $id): JsonResponse
    {
        $task = $this->projectTaskService->findBy([
            'id' => $id,
            'project_id' => $projectId,
        ])->first();

        if (!$task) {
            return $this->responseWithError('Task not found', 404);
        }

        return $this->responseWithEntity($task);
    }

    /**
     * @param Request $request
     * @param int $projectId
     * @return JsonResponse
     */
    public function list(Request $request, int $projectId): JsonResponse
    {
        return $this->responseWithEntity(
            $this->projectTaskService->getProjectAssignedList(
                $projectId,
                $request->user()->getId()
            )
        );
    }

    /**
     * @param ProjectTaskCreateRequest $request
     * @param int $projectId
     * @return JsonResponse
     */
    public function create(ProjectTaskCreateRequest $request, int $projectId): JsonResponse
    {
        try {
            $project = $this->projectService->findBy([
                'id' => $projectId,
                'user_id' => $request->user()->getId(),
            ])->first();

            if (!$project) {
                return $this->responseWithError('Project not found', 404);
            }

            $task = $this->projectTaskService->create(array_merge($request->validated(), [
                'project_id' => $projectId,
                'author_id' => $request->user()->getId(),
            ]));

            return $this->responseWithEntity($task, 201);
        } catch (\Throwable $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    /**
     * @param ProjectTaskUpdateRequest $request
     * @param int $projectId
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProjectTaskUpdateRequest $request, int $projectId, int $id): JsonResponse
    {
        try {
            $project = $this->projectService->findBy([
                'id' => $projectId,
                'user_id' => $request->user()->getId(),
            ])->first();

            if (!$project) {
                return $this->responseWithError('Project not found', 404);
            }

            $task = $this->projectTaskService->findBy([
                'id' => $id,
                'project_id' => $projectId,
            ])->first();

            if (!$task) {
                return $this->responseWithError('Task not found.', 404);
            }

            $this->projectTaskService->update($task, $request->validated());

            return $this->responseWithEntity($task);
        } catch (\Throwable $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param int $projectId
     * @param int $id
     * @return JsonResponse
     */
    public function delete(Request $request, int $projectId, int $id): JsonResponse
    {
        $project = $this->projectService->findBy([
            'id' => $projectId,
            'user_id' => $request->user()->getId(),
        ])->first();

        if (!$project) {
            return $this->responseWithError('Project not found', 404);
        }

        $task = $this->projectTaskService->findBy([
            'id' => $id,
            'project_id' => $projectId,
        ])->first();

        if (!$task) {
            return $this->responseWithError('Task not found', 404);
        }

        if (!$this->projectTaskService->delete($task)) {
            return $this->responseWithError('Task not deleted', 422);
        }

        return $this->responseWithMessage('', 204);
    }
}
