<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ByCountry
{
    public function __construct(protected Request $request)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)->when(
            $this->request->has('country'),
            fn ($query) => $query->where('country', $this->request->get('country'))
        );
    }
}
