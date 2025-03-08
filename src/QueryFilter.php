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

class QueryFilter implements QueryFilterInterface
{
    /**
     * QueryFilter constructor
     */
    public function __construct(
        private readonly Pipeline $pipeline
    ) {}

    /**
     * Apply filters to the query builder
     *
     * @param Builder $builder
     * @param array $pipes
     * @return Builder
     */
    public function query(Builder $builder, array $pipes = []): Builder
    {
        return $this->pipeline
            ->send($builder)
            ->through($pipes)
            ->thenReturn();
    }
}