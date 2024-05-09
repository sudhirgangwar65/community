<?php

namespace App\Core;

class Widgets
{
    public static function setSideBarWidget($list)
    {
        register_sidebar($list);
    }
}
