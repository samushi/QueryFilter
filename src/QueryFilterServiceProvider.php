<?php

namespace Samushi\QueryFilter;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\ServiceProvider;
use Samushi\QueryFilter\Contract\QueryFilterInterface;
use Samushi\QueryFilter\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Samushi\QueryFilter\Mixins\Mixins;

class QueryFilterServiceProvider extends ServiceProvider
{

    public function boot(){
        // Load Mixins
        Builder::mixin(new Mixins);
    }

    public function register()
    {
        // Register Facade
        $this->app->bind(QueryFilterInterface::class, function($app){
            return new QueryFilter($app->make(Pipeline::class));
        });
    }
}
