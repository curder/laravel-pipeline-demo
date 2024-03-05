<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->has('role'), function (Builder $query) use ($request) {
                return $query->where('role', $request->role);
            })
            ->when($request->has('country'), function(Builder $query) use ($request) {
                return $query->where('country',$request->country);
            })
            ->orderByDesc('id')
            ->paginate();

        return UsersResource::collection($users);
    }
}