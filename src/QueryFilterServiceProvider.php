<?php
/**
 * File QueryFilterServiceProvider.php.
 * @copyright 2021
 * @version 1.0
 */

namespace Samushi\QueryFilter;


use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\ServiceProvider;
use Samushi\QueryFilter\Contract\QueryFilterInterface;
use Samushi\QueryFilter\QueryFilter;

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
