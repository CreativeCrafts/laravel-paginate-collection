<?php

use CreativeCrafts\Paginate\Facades\Paginate as PaginateFacade;
use CreativeCrafts\Paginate\Paginate;

it('can paginate a collection using the facade', function () {
    $collection = collect([
        ['name' => 'John', 'age' => 30],
        ['name' => 'Jane', 'age' => 25],
        ['name' => 'Jack', 'age' => 40],
    ]);

    $paginatedCollection = PaginateFacade::collection($collection, 2);
    expect($paginatedCollection)->toHaveCount(2)
        ->and($paginatedCollection->first())->toBe([
            'name' => 'John',
            'age' => 30,
        ]);
});

it('can paginate a collection using the static function', function () {
    $collection = collect([
        ['name' => 'Jack', 'age' => 40],
        ['name' => 'John', 'age' => 30],
        ['name' => 'Jane', 'age' => 25],
    ]);

    $paginatedCollection = Paginate::collection($collection, 1);
    expect($paginatedCollection)->toHaveCount(1)
        ->and($paginatedCollection->first())->toBe([
            'name' => 'Jack',
            'age' => 40,
        ]);
});

it(
    'can paginate a collection using the default items per page set in config', function () {
        $collection = collect([
            ['name' => 'Jack', 'age' => 40],
            ['name' => 'John', 'age' => 30],
            ['name' => 'Jane', 'age' => 25],
            ['name' => 'Jack', 'age' => 40],
            ['name' => 'John', 'age' => 30],
            ['name' => 'Jane', 'age' => 25],
            ['name' => 'Jack', 'age' => 40],
            ['name' => 'John', 'age' => 30],
            ['name' => 'Jane', 'age' => 25],
            ['name' => 'Jack', 'age' => 40],
            ['name' => 'John', 'age' => 30],
            ['name' => 'Jane', 'age' => 25],
            ['name' => 'Jack', 'age' => 40],
            ['name' => 'John', 'age' => 30],
            ['name' => 'Jane', 'age' => 25],
            ['name' => 'Jack', 'age' => 40],
            ['name' => 'John', 'age' => 30],
            ['name' => 'Jane', 'age' => 25],
        ]);

        $paginatedCollection = Paginate::collection($collection, null);
        expect($paginatedCollection)->toHaveCount(10);
    });
