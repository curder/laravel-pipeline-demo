<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ByName
{
    public function __construct(protected Request $request)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)->when(
            $this->request->has('name'),
            fn (Builder $query) => $query->where('name', 'like', "%{$this->request->get('name')}%")
        );
    }
}
