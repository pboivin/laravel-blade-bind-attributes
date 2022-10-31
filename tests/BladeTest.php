<?php

namespace Pboivin\LaravelBladeBindAttributes\Tests;

use Illuminate\Support\Facades\Blade;

class BladeTest extends TestCase
{
    protected function afterSetup()
    {
        $this->copy([
            'components' => resource_path('views/components'),
        ]);
    }

    public function test_classless_component_has_default_props()
    {
        $output = Blade::render('<x-header />', []);

        $this->assertEquals('<div >Default - Default</div>', trim($output));
    }

    public function test_classless_component_supports_bound_attributes()
    {
        $output = Blade::render('<x-header @bind="$header" />', [
            'header' => [
                'title' => 'Title',
                'subtitle' => 'Subtitle',
            ],
        ]);

        $this->assertEquals('<div >Title - Subtitle</div>', trim($output));
    }

    public function test_classless_component_merges_bound_attributes()
    {
        $output = Blade::render('<x-header @bind="$header" class="my-header" />', [
            'header' => [
                'title' => 'Title',
                'subtitle' => 'Subtitle',
            ],
        ]);

        $this->assertEquals('<div class="my-header">Title - Subtitle</div>', trim($output));
    }
}
