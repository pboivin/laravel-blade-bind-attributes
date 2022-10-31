<?php

namespace Pboivin\LaravelBladeBindAttributes;

use Illuminate\View\Compilers\ComponentTagCompiler as BaseComponentTagCompiler;

class ComponentTagCompiler extends BaseComponentTagCompiler
{
    /**
     * Convert an array of attributes to a string.
     *
     * @param  array  $attributes
     * @param  bool  $escapeBound
     * @return string
     */
    protected function attributesToString(array $attributes, $escapeBound = true)
    {
        [$bound, $other] = collect($attributes)
            ->partition(function (string $value, string $attribute) {
                return $attribute === '@bind';
            });

        $bound = $bound
            ->map(fn ($value) => '...' . $this->stripQuotes($value))
            ->join(',');

        $other = parent::attributesToString($other->all(), $escapeBound);

        return collect([$bound, $other])->filter()->join(',');
    }
}
