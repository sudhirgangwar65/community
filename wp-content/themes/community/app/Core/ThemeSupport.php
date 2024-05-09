<?php

namespace App\Core;

class ThemeSupport
{
    public static function setTitleTag()
    {
        add_theme_support('title-tag'); // Setup Title Tag
    }
    public static function setUpLogo($list)
    {
        /** custom log **/
        add_theme_support('custom-logo', $list); // setup logo
    }
}
