<?php

namespace App\Inc;

class Enqueue
{
    public function boot()
    {
        \App\Core\Enqueue::setMainStyle();
        // css include
        \App\Core\Enqueue::setStyle('main-css', 'assets/css/main.css');



        // js Include
        \App\Core\Enqueue::setScript('main-js', 'assets/js/main.js');
		//\App\Core\Enqueue::setScript('main-video', 'assets/js/video/main.js');
    }
}
