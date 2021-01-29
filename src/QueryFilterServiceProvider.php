<?php
/**
 * File QueryFilterServiceProvider.php.
 * @copyright 2021
 * @version 1.0
 */

namespace Laracodes\QueryFilter;


use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\ServiceProvider;
use Laracodes\QueryFilter\Contract\QueryFilterInterface;
use Laracodes\QueryFilter\QueryFilter;

class QueryFilterServiceProvider extends ServiceProvider
{

    public function boot(){

    }

    public function register()
    {
        $this->app->bind(QueryFilterInterface::class, function($app){
            return new QueryFilter($app->make(Pipeline::class));
        });
    }
}
