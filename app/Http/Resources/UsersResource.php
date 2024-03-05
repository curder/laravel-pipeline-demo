<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User $resource
 */
final class UsersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'role' => $this->resource->role,
            'country' => $this->resource->country,
        ];
    }
}
