<?php

namespace Samushi\QueryFilter;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Get the requests
     * @return Request
     */
    private function getRequests(): Request
    {
        return app(Request::class);
    }

    /**
     * Middleware handle method
     *
     * @param Builder $builder
     * @param Closure $next
     * @return Builder
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        $request = $this->getRequests();
        if (!$request->has($this->filterName()) || $request->get($this->filterName()) === "") {
            return $next($builder);
        }
        $builder = $this->applyFilter($builder);
        return $next($builder);
    }

    /**
     * Apply the filter to the builder
     *
     * @param Builder $builder
     * @return Builder
     */
    protected abstract function applyFilter(Builder $builder): Builder;

    /**
     * Get the filter value from the request
     *
     * @return string
     */
    protected function getValue(): string
    {
        return (string) $this->getRequests()->get($this->filterName());
    }

    /**
     * Get the filter name
     *
     * @return string
     */
    protected function filterName(): string
    {
        if ($this->name) {
            return $this->name;
        }

        return Str::snake(class_basename($this));
    }
}