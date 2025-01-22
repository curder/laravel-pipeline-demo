<?php

declare(strict_types=1);

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

final class ByCountry
{
    public function __construct(protected ?string $country)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)->when(
            $this->country,
            fn ($query) => $query->where('country', $this->country)
        );
    }
}
