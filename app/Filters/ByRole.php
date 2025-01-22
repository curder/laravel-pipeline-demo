<?php

declare(strict_types=1);

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

final class ByRole
{
    public function __construct(protected ?string $role)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when(
                $this->role,
                fn ($query) => $query->where('role', $this->role)
            );
    }
}
