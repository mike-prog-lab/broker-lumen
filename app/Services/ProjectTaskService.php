<?php


namespace App\Services;


use App\Repositories\ProjectTaskRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProjectTaskService
 * @package App\Services
 */
final class ProjectTaskService extends EntityService
{
    /**
     * ProjectTaskService constructor.
     * @param ProjectTaskRepository $repository
     */
    public function __construct(ProjectTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @param int $userId
     * @return Collection
     */
    public function getProjectAssignedList(int $id, int $userId): Collection
    {
        return $this->repository->findBy([
            'project_id' => $id,
            'assignee_id' => $userId,
        ]);
    }
}
