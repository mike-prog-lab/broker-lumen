<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectTask
 *
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $project_id
 * @property int $project_task_status_id
 * @property int $author_id
 * @property int $assignee_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereAssigneeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereProjectTaskStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereUpdatedAt($value)
 */
class ProjectTask extends Model
{
    protected $fillable = [
        'title',
        'description',
        'project_id',
        'project_task_status_id',
        'author_id',
        'assignee_id',
    ];
}
