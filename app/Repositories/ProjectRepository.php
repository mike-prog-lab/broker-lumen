<?php


namespace App\Repositories;


use App\Models\Project;

/**
 * Class ProjectRepository
 * @package App\Repositories
 */
class ProjectRepository extends Repository
{
    /**
     * ProjectRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(Project::class);
    }
}
