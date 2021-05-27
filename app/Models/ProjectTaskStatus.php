<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectTaskStatus
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTaskStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTaskStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTaskStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTaskStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTaskStatus whereName($value)
 */
class ProjectTaskStatus extends Model
{
    public const TODO = 1;
    public const IN_PROGRESS = 2;
    public const DONE = 3;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];
}
