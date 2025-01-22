<?php

declare(strict_types=1);

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

final class ByName
{
    public function __construct(protected ?string $name)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)->when(
            $this->name,
            fn (Builder $query) => $query->where('name', 'like', "%{$this->name}%")
        );
    }
}
