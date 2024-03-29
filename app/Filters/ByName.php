<?php

declare(strict_types=1);

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class ByName
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
