<?php

namespace App\Core;

class NavMenus
{
    public function boot()
    {
        $this->setUpNavMenu();
    }
    public function setUpNavMenu()
    {
        register_nav_menus([
            'primary_menu' => esc_html__('Primary Menu', 'codeflies'),
            'footer_menu'  => esc_html__('Footer Menu', 'codeflies')
        ]);
    }
}
