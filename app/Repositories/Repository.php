<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use KrazyDanny\Laravel\Repository\BaseRepository;

/**
 * Class Repository
 * @package App\Repositories
 */
abstract class Repository extends BaseRepository
{
    /**
     * @var Model
     */
    protected Model $queryModel;

    /**
     * Repository constructor.
     * @param string $class
     * @param string|null $cache_prefix
     */
    public function __construct(string $class, string $cache_prefix = null)
    {
        parent::__construct($class, $cache_prefix);

        $this->queryModel = new $class;
    }

    /**
     * @return Builder
     */
    protected function initBuilder(): Builder
    {
        return $this->queryModel->newModelQuery();
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function findBy(array $data): Collection
    {
        return $this->find($this->initBuilder()->where($data));
    }

    /**
     * @param Builder|null $queryBuilder
     * @return string
     */
    public function generateQueryCacheKey(Builder $queryBuilder = null): string
    {
        if ( $queryBuilder ) {
            return $this->cachePrefix.':q:'.$this->hashQuery($queryBuilder->getQuery());
        } else {
            return $this->cachePrefix.':q:all';
        }
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return false|string
     */
    private function hashQuery(\Illuminate\Database\Query\Builder $query)
    {
        return hash('sha1', \Opis\Closure\serialize($query));
    }
}
