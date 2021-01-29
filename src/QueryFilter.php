<?php
/**
 * File QueryFilter.php.
 * @copyright 2021
 * @version 1.0
 */

namespace Laracodes\QueryFilter;

use Laracodes\QueryFilter\Contract\QueryFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class QueryFilter implements QueryFilterInterface
{
    /**
     * @var Pipeline
     */
    private $pipeline;

    /**
     * QueryFilter constructor.
     * @param Pipeline $pipeline
     */
    public function __construct(Pipeline $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    /**
     * Query Filter
     * @param Builder $builder
     * @param array $pipes
     * @return mixed
     */
    public function query(Builder $builder, $pipes = [])
    {
        return $this->pipeline
            ->send($builder)
            ->through($pipes)
            ->thenReturn();
    }
}
