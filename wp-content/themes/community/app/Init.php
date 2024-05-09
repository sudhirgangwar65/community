<?php

namespace App;

class Init
{
    private static $instance = null; // instance variable must be private static
    private function __construct() // constructor must be private
    {
        Inc\Main\Base::boot();
    }


    public static function getInstance()  // getInstance function must be private and static
    {
        if (self::$instance == null) {
            self::$instance = new Init();
        }
        return self::$instance;
    }
}
