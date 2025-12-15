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
     * @var array|null
     */
    protected ?array $data = null;

    /**
     * Filter constructor
     *
     * @param array|null $data Optional data array for non-HTTP contexts (Jobs, Commands, etc.)
     */
    public function __construct(?array $data = null)
    {
        $this->data = $data;
    }

    /**
     * Get the requests
     * @return Request
     */
    private function getRequests(): Request
    {
        return app(Request::class);
    }

    /**
     * Get the raw value from data or request
     *
     * @return mixed
     */
    private function getValueSource(): mixed
    {
        return $this->data[$this->filterName()]
               ?? $this->getRequests()->get($this->filterName());
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
        $value = $this->getValueSource();

        if ($value === null || $value === "") {
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
     * Get the filter value from the request or data
     *
     * @param bool $asArray Whether to return the value as an array
     * @return string|array
     */
    protected function getValue(bool $asArray = false): string|array
    {
        $value = $this->getValueSource();

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