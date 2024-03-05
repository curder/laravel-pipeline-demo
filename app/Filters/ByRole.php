<?php

declare(strict_types=1);

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
