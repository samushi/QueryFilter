<?php

namespace Samushi\QueryFilter;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\ServiceProvider;
use Samushi\QueryFilter\Contract\QueryFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Samushi\QueryFilter\Mixins\Mixins;

class QueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load Mixins
        Builder::mixin(new Mixins);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register Facade
        $this->app->bind(QueryFilterInterface::class, function($app) {
            return new QueryFilter($app->make(Pipeline::class));
        });
    }
}