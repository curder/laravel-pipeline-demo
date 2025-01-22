<?php

declare(strict_types=1);

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

final class ByRole
{
    public function __construct(protected Request $request)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when(
                $this->request->has('role'),
                fn ($query) => $query->where('role', $this->request->get('role'))
            );
    }
}
