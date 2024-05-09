<?php

namespace App\Inc;

class Widgets
{
    public function boot()
    {
        // Register Side Bar Widgets
        \App\Core\Widgets::setSideBarWidget([
            'name' => __('Main Sidebar', 'textdomain'),
            'id' => 'sidebar-1',
            'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>'
        ]);
    }
}
