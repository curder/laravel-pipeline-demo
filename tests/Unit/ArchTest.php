<?php

test('globals')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

test('filters')
    ->expect('App\Filters')
    ->toBeFinal()
    ->toBeClasses();

test('http.controllers.api')
    ->expect('App\Http\Controllers\Api')
    ->toHaveSuffix('Controller')
    ->toBeClasses();

test('models')
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend('Illuminate\Database\Eloquent\Model');

test('providers')
    ->expect('App\Providers')
    ->toHaveSuffix('ServiceProvider')
    ->toBeClasses()
    ->toExtend('Illuminate\Support\ServiceProvider');
