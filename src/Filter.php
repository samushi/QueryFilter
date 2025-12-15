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
     * @param bool $asArray Whether to return the value as an array
     * @return string|array
     */
    protected function getValue(bool $asArray = false): string|array
    {
        $value = $this->getRequests()->get($this->filterName());

        // If value is already an array (e.g., ?cases[]=sent&cases[]=delivered)
        if (is_array($value)) {
            return $asArray ? $value : implode(',', $value);
        }

        // If asArray is true and value is a comma-separated string
        if ($asArray && is_string($value) && str_contains($value, ',')) {
            return array_map('trim', explode(',', $value));
        }

        // If asArray is true but no comma, return as single-element array
        if ($asArray) {
            return [$value];
        }

        return (string) $value;
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