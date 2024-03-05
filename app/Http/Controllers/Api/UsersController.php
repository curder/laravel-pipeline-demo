<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Filters\ByRole;
use App\Filters\ByCountry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use Illuminate\Support\Facades\Pipeline;

class UsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $pipelines = [
            \App\Filters\ByName::class,
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
