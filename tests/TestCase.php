<?php

namespace Pboivin\LaravelBladeBindAttributes\Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Pboivin\LaravelBladeBindAttributes\ServiceProvider;

class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        File::deleteDirectory(resource_path('views/components'));
        File::deleteDirectory(resource_path('views'));

        $this->afterSetup();
    }

    protected function afterSetup()
    {
        //
    }

    protected function copy($filesMap)
    {
        foreach ($filesMap as $source => $destination) {
            $sourcePath = __DIR__ . '/fixtures/' . $source;

            File::ensureDirectoryExists(dirname($destination));

            if (File::isDirectory($sourcePath)) {
                File::copyDirectory($sourcePath, $destination);
            } else {
                File::copy($sourcePath, $destination);
            }
        }
    }
}
