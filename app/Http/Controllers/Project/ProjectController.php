<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectCreateRequest;
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
     * @param ProjectCreateRequest $request
     * @return JsonResponse
     */
    public function create(ProjectCreateRequest $request): JsonResponse
    {
        try {
            $this->service->create(array_merge($request->validated(), [
                'user_id' => $request->user()->getId(),
            ]));

            return $this->responseWithMessage('', 201);
        } catch (\Throwable $exception) {
            return $this->responseWithError('Server error');
        }
    }
}
