<?php

namespace App\Inc\Main;

class Base
{
    public static function boot()
    {
        add_action('wp_enqueue_scripts', [new \App\Inc\Enqueue, 'boot']); // Setup Enqueque Script
        add_action('after_setup_theme', [new \App\Core\NavMenus, 'boot']); // Setup Register Menu
        add_action('widgets_init', [new \App\Inc\Widgets, 'boot']); // Setup Register Menu
        add_action('after_setup_theme', [new \App\Inc\ThemeSupport, 'boot']); // Setup Theme Support Methods
        add_action('init', [new \App\Inc\Post, 'boot']); // Setup Register Menu
    }
}
