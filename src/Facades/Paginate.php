<?php

namespace CreativeCrafts\Paginate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CreativeCrafts\Paginate\Paginate
 */
class Paginate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CreativeCrafts\Paginate\Paginate::class;
    }
}
