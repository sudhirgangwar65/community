<?php

namespace App\Core;

class Enqueue
{
    public static function setMainStyle()
    {
        wp_enqueue_style('style-css', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');
    }
    public static function setStyle($id, $asssets_directory)
    {
        wp_enqueue_style($id, get_template_directory_uri() . '/public/' . $asssets_directory, [], filemtime(get_template_directory() . '/public/' . $asssets_directory), 'all');
    }
    public static function setScript($id, $asssets_directory)
    {
        wp_enqueue_script($id, get_template_directory_uri() . '/public/' . $asssets_directory, [], filemtime(get_template_directory() . '/public/' . $asssets_directory), true);
    }
}
