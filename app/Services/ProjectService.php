<?php


namespace App\Services;


use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Collection;

/**
 * Class ProjectService
 * @package App\Services
 */
final class ProjectService extends EntityService
{
    /**
     * @var array
     */
    protected array $userListAttributes = [
        'id',
        'title',
        'description',
        'created_at',
        'updated_at',
    ];

    /**
     * ProjectService constructor.
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserList(int $userId): Collection
    {
        return $this->repository->findBy([
            'user_id' => $userId,
        ])->map(function (Project $project) {
            return $project->only($this->userListAttributes);
        });
    }
}
