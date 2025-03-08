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
     * Middleware handle method
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!$request->has($this->filterName()) || $request->get($this->filterName()) === "") {
            return $next($request);
        }

        $builder = $next($request);
        return $this->applyFilter($builder);
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
        return (string) request($this->filterName());
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