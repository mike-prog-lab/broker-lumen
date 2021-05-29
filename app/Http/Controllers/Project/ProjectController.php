<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectCreateRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ProjectController
 * @package App\Http\Controllers\Project
 */
final class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    protected ProjectService $service;

    /**
     * ProjectController constructor.
     * @param ProjectService $service
     */
    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function index(Request $request, int $id): JsonResponse
    {
        $project = $this->service->findBy([
            'id' => $id,
            'user_id' => $request->user()->getId(),
        ])->first();

        if (!$project) {
            return $this->responseWithError('Project not found', 404);
        }

        return $this->responseWithEntity($project);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        return $this->responseWithEntity(
            $this->service->getUserList(
                $request->user()->getId(),
            )
        );
    }

    /**
     * @param ProjectCreateRequest $request
     * @return JsonResponse
     */
    public function create(ProjectCreateRequest $request): JsonResponse
    {
        try {
            $project = $this->service->create(array_merge($request->validated(), [
                'user_id' => $request->user()->getId(),
            ]));

            return $this->responseWithEntity($project, 201);
        } catch (\Throwable $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    /**
     * @param ProjectUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProjectUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $project = $this->service->findBy([
                'id' => $id,
                'user_id' => $request->user()->getId(),
            ])->first();

            if (!$project) {
                return $this->responseWithError('Project not found.', 404);
            }

            $this->service->update($project, $request->only([
                'title',
                'description',
            ]));

            return $this->responseWithEntity($project);
        } catch (\Throwable $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function delete(Request $request, int $id): JsonResponse
    {
        $project = $this->service->findBy([
            'id' => $id,
            'user_id' => $request->user()->getId(),
        ])->first();

        if (!$project) {
            return $this->responseWithError('Project not found', 404);
        }

        if (!$this->service->delete($project)) {
            return $this->responseWithError('Project not deleted', 422);
        }

        return $this->responseWithMessage('', 204);
    }
}
