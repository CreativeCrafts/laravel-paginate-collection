<?php

namespace CreativeCrafts\Paginate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PaginateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-paginate-collection')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->bind('paginate', function () {
            return new Paginate;
        });
    }
}
