<?php
/**
 * File QueryFilterInterface.php.
 * @copyright 2021
 * @version 1.0
 */

namespace Laracodes\QueryFilter\Contract;


use Illuminate\Database\Eloquent\Builder;

interface QueryFilterInterface
{
    /**
     * Query Filters Builder
     * @param Builder $builder
     * @param array $filters
     * @return mixed
     */
    public function query(Builder $builder, $filters = []);
}
