<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Filters\ByName;
use App\Filters\ByRole;
use App\Filters\ByCountry;
use App\Filters\SortUsers;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use Illuminate\Support\Facades\Pipeline;

final class UsersController
{
    public function __invoke(Request $request)
    {
        $pipelines = [
            new ByName($request->get('name')),
            new ByRole($request->get('role')),
            new ByCountry($request->get('country')),
            SortUsers::class,
        ];

        $users = Pipeline::send(User::query())
            ->through($pipelines)
            ->thenReturn()
            ->paginate();

        return UsersResource::collection($users);
    }
}
