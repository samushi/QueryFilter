<?php
/**
 * File QueryFilter.php
 * @copyright 2025
 * @version 2.0
 */

namespace Samushi\QueryFilter;

use Samushi\QueryFilter\Contract\QueryFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

readonly class QueryFilter implements QueryFilterInterface
{
    /**
     * QueryFilter constructor
     */
    public function __construct(
        private Pipeline $pipeline
    ) {}

    /**
     * Apply filters to the query builder
     *
     * @param Builder $builder
     * @param array $filters
     * @return Builder
     */
    public function query(Builder $builder, array $filters = []): Builder
    {
        return $this->pipeline
            ->send($builder)
            ->through($filters)
            ->thenReturn();
    }
}