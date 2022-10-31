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

        $this->cleanup();

        $this->afterSetup();
    }

    protected function cleanup()
    {
        File::deleteDirectory(app_path('View'));

        File::deleteDirectory(resource_path('views'));
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
