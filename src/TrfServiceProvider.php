<?php

namespace Chessfy\Trf;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Chessfy\Trf\Commands\TrfCommand;

class TrfServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
             * This class is a Package Service Provider
             *
             * More info: https://github.com/spatie/laravel-package-tools
             */
        $package
      ->name('trf')
      ->hasConfigFile()
      ->hasViews()
      ->hasMigration('create_trf_table')
      ->hasCommand(TrfCommand::class);
    }
}
