<?php

namespace App\Inc;

class ThemeSupport
{
    public function boot()
    {
        // Set Up Title Tag
        \App\Core\ThemeSupport::setTitleTag();
        // Setup Custom Logo
        \App\Core\ThemeSupport::setUpLogo([
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => ['site-title', 'site-description'],
        ]);
    }
}
