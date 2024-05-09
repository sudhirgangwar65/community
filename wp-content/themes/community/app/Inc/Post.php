<?php

namespace App\Inc;

class Post
{
    public function boot()
    {
        // Register Post
        \App\Core\Post::registerPost([
            'name' => 'Articles',
            'singular_name' => 'Article',
            'theme_name' => 'twentytwentyone',
            'post_type' => 'article',
            'rewrite_slug' => 'article',
            'menu_postion' => 5,
            'supporst' => ['title','editor','thumbnail','excerpt'],
            'menu_dashicon' => 'dashicons-groups'
        ]);

        // \App\Core\Post::registerPost([
        //     'name' => 'Movie',
        //     'singular_name' => 'Movie',
        //     'theme_name' => 'Codeflies',
        //     'post_type' => 'movie',
        //     'rewrite_slug' => 'movie',
        //     'menu_postion' => 2,
        //     'supporst' => ['title'],
        //     'menu_dashicon' => 'dashicons-welcome-write-blog'
        // ]);
        // Taxonomy 
        

         \App\Core\Post::setUpTaxonomy(['name' => 'Type', 'taxonomy' => 'products-type', 'post_type' => 'product']);
         \App\Core\Post::setUpTaxonomy(['name' => 'Quality', 'taxonomy' => 'products-quality', 'post_type' => 'product']);
         \App\Core\Post::setUpTaxonomy(['name' => 'Homam Types', 'taxonomy' => 'homam-types', 'post_type' => 'product']);
         

         \App\Core\Post::setUpTaxonomy(['name' => 'Article Category', 'taxonomy' => 'article-category', 'post_type' => 'article']);
         \App\Core\Post::setUpTaxonomy(['name' => 'Article Tags', 'taxonomy' => 'article-tags', 'post_type' => 'article']);

    }
}
