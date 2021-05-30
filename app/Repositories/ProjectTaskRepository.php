<?php


namespace App\Repositories;


use App\Models\ProjectTask;

/**
 * Class ProjectTaskRepository
 * @package App\Repositories
 */
class ProjectTaskRepository extends Repository
{
    /**
     * ProjectTaskRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(ProjectTask::class, 'ProjectTasks');
    }
}
