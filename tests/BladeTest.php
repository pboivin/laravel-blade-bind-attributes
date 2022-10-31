<?php

namespace Pboivin\LaravelBladeBindAttributes\Tests;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;

class BladeTest extends TestCase
{
    protected function afterSetup()
    {
        $this->copy([
            'app/View' => app_path('View'),
            'resources/views' => resource_path('views'),
        ]);

        Config::set('view.cache', false);
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

    public function test_classless_component_merges_other_attributes()
    {
        $output = Blade::render('<x-header @bind="$header" class="my-header" />', [
            'header' => [
                'title' => 'Title',
                'subtitle' => 'Subtitle',
            ],
        ]);

        $this->assertEquals('<div class="my-header">Title - Subtitle</div>', trim($output));
    }

    public function test_class_component_has_default_props()
    {
        $output = Blade::render('<x-footer />', []);

        $this->assertEquals('<div >Default - Default</div>', trim($output));
    }

    public function test_class_component_supports_bound_attributes()
    {
        $output = Blade::render('<x-footer @bind="$footer" />', [
            'footer' => [
                'title' => 'Title',
                'subtitle' => 'Subtitle',
            ],
        ]);

        $this->assertEquals('<div >Title - Subtitle</div>', trim($output));
    }

    public function test_class_component_merges_other_attributes()
    {
        $output = Blade::render('<x-footer @bind="$footer" class="my-footer" />', [
            'footer' => [
                'title' => 'Title',
                'subtitle' => 'Subtitle',
            ],
        ]);

        $this->assertEquals('<div class="my-footer">Title - Subtitle</div>', trim($output));
    }
}
