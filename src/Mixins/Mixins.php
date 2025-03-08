<?php

namespace Samushi\QueryFilter\Mixins;

use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Mixins
{
    /**
     * Search anything from query by relationship
     *
     * @return Closure
     */
    public function whereLike(): Closure
    {
        return function(array|string $attributes, string $searchTerm): Builder {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        };
    }

    /**
     * Search by date between
     *
     * @return Closure
     */
    public function whereDateBetween(): Closure
    {
        return function(string $attribute, string $fromDate, string $toDate, string $fromFormat = 'd/m/Y', string $toFormat = 'Y-m-d'): Builder {
            $startDate = Carbon::createFromFormat($fromFormat, $fromDate)->format($toFormat);
            $endDate = Carbon::createFromFormat($fromFormat, $toDate)->format($toFormat);

            return $this->whereDate($attribute, '>=', $startDate)
                ->whereDate($attribute, '<=', $endDate);
        };
    }
}