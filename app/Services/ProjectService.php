<?php


namespace App\Services;


use App\Models\Project;

/**
 * Class ProjectService
 * @package App\Services
 */
final class ProjectService
{
    /**
     * @param array $data
     * @return Project
     * @throws \Throwable
     */
    public function create(array $data): Project
    {
        return Project::create($data);
    }
}
