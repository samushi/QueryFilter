<?php
/**
 * File QueryFilter.php.
 * @copyright 2021
 * @version 1.0
 */

namespace Laracodes\QueryFilter\Facade;


use Illuminate\Support\Facades\Facade;
use Laracodes\QueryFilter\Contract\QueryFilterInterface;

class QueryFilter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return QueryFilterInterface::class;
    }
}
