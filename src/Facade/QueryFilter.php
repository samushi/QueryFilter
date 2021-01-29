<?php
/**
 * File QueryFilter.php.
 * @copyright 2021
 * @version 1.0
 */

namespace Samushi\QueryFilter\Facade;


use Illuminate\Support\Facades\Facade;
use Samushi\QueryFilter\Contract\QueryFilterInterface;

class QueryFilter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return QueryFilterInterface::class;
    }
}
