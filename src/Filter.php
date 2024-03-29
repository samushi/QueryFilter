<?php

namespace Samushi\QueryFilter;


use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var null|string
     */
    protected ?string $name = null;

    /**
     * Middleware handle
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(
            !request()->has($this->fillterName()) ||
            request()->get($this->fillterName()) === ""
        )
        {
            return $next($request);
        }

        $builder = $next($request);
        return $this->applyFilter($builder);
    }

    /**
     * Apply filter
     * @param $builder
     * @return mixed
     */
    protected abstract function applyFilter($builder);

    /**
     * Get Value
     * @return string
     */
    protected function getValue() : string
    {
        return request($this->fillterName());
    }

    /**
     * Filter class name
     * @return string
     */
    protected function fillterName()
    {
        if($this->name)
            return $this->name;

        return Str::snake(class_basename($this));
    }

}
