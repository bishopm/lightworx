<?php

use Bishopm\Lightworx\Models\Setting; 

if (! function_exists('setting')) {
    function setting(string $slug, $default = null)
    {
        return Setting::where('setting', $slug)->value('value') ?? $default;
    }
}