<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/
uses(TestCase::class, RefreshDatabase::class)->in('Feature');
uses(TestCase::class)->in('Unit');

// O si prefieres configurar traits globales para todos los tests:
uses([
    RefreshDatabase::class,
    Illuminate\Foundation\Testing\LazilyRefreshDatabase::class,
    Illuminate\Foundation\Testing\WithFaker::class,
])->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
*/
expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

// Ejemplo de expectativa personalizada útil para Laravel
expect()->extend('toBeSuccessful', function () {
    return $this->toBeGreaterThanOrEqual(200)
        ->toBeLessThan(300);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/
function createUser(array $attributes = [])
{
    return \App\Models\User::factory()->create($attributes);
}

function makeUser(array $attributes = [])
{
    return \App\Models\User::factory()->make($attributes);
}

function actingAsUser($user = null)
{
    return test()->actingAs($user ?? createUser());
}