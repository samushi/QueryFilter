<?php
/**
 * File QueryFilter.php
 * @copyright 2025
 * @version 2.0
 */

namespace Samushi\QueryFilter\Facade;

use Illuminate\Support\Facades\Facade;
use Samushi\QueryFilter\Contract\QueryFilterInterface;

class QueryFilter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return QueryFilterInterface::class;
    }
}