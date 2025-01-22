<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

final class SortUsers
{
    public function handle(Builder $query, Closure $next)
    {
        return $next($query)->orderByDesc('id');
    }
}
