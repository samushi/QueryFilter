<?php

namespace Samushi\QueryFilter\Mixins;

use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @method where
 * @method whereDate
 */
class Mixins {
    /**
     * Search anything from query by realtionship
     *
     * @return Closure
     */
    public function whereLike(): Closure
    {
        return function($attributes, string $searchTerm){
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
     * @return Closure
     */
    public function whereDateBetween() : Closure
    {
        return function($attributes, $fromDate, $toDate, $fformat = 'd/m/Y', $tformat = 'Y-m-d') {

            $start_date = Carbon::createFromFormat($fformat, $fromDate)->format($tformat);
            $end_date   = Carbon::createFromFormat($fformat, $toDate)->format($tformat);


            return $this->whereDate($attributes,'>=',$start_date)
                        ->whereDate($attributes,'<=',$end_date);
        };
    }
}