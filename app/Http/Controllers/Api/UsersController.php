<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Filters\ByName;
use App\Filters\ByRole;
use App\Filters\ByCountry;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use Illuminate\Support\Facades\Pipeline;

final class UsersController
{
    public function __invoke(Request $request)
    {
        $pipelines = [
            ByName::class,
            ByRole::class,
            ByCountry::class,
        ];

        $users = Pipeline::send(User::query())
            ->through($pipelines)
            ->thenReturn()
            ->orderByDesc('id')
            ->paginate();

        return UsersResource::collection($users);
    }
}
