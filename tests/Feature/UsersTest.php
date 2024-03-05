<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('returns a successful response', function () {
    $this->get('/api/users')
        ->assertOk()
        // has paginate
        ->assertJsonPath('data', [])
        ->assertJsonStructure(['data', 'links', 'meta']);

    User::factory()->times(4)->create();

    $this->get('/api/users')
        ->assertOk()
        ->assertJsonCount(4,'data');
});

it('has default order by id desc', function () {
    $last = User::factory()->create();
    User::factory()->times(2)->create();
    $first = User::factory()->create();

    $this->get('/api/users')
        ->assertOk()
        ->assertJsonCount(4,'data')
        ->assertSeeTextInOrder([$first->name, $last->name]);
});

it('can filter by user role', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $manger = User::factory()->create(['role' => 'manager']);

    $this->get('/api/users?role=admin')
        ->assertOk()
        ->assertJsonCount(1,'data')
        ->assertJsonPath('data.0.name', $admin->name)
        ->assertJsonPath('data.0.email', $admin->email)
        ->assertJsonPath('data.0.role', $admin->role)
        ->assertJsonMissingExact([
            'name' => $manger->name,
            'email' => $manger->email,
            'role' => $manger->role,
        ]);
});

it('can filter by user country', function () {
    $niger = User::factory()->create(['country' => 'Niger']);
    $gambia = User::factory()->create(['country' => 'Gambia']);

    $this->get('/api/users?country=Niger')
        ->assertOk()
        ->assertJsonCount(1,'data')
        ->assertJsonPath('data.0.name', $niger->name)
        ->assertJsonPath('data.0.email', $niger->email)
        ->assertJsonPath('data.0.country', $niger->country)
        ->assertJsonMissingExact([
            'name' => $gambia->name,
            'email' => $gambia->email,
            'country' => $gambia->country,
        ])
    ;
});

