<?php
/**
 * File QueryFilterInterface.php
 * @copyright 2025
 * @version 2.0
 */

namespace Samushi\QueryFilter\Contract;

use Illuminate\Database\Eloquent\Builder;

interface QueryFilterInterface
{
    /**
     * Query Filters Builder
     *
     * @param Builder $builder
     * @param array $filters
     * @return Builder
     */
    public function query(Builder $builder, array $filters = []): Builder;
}