<?php

namespace App\Core;

class Post
{
    public static function registerPost($data)
    {
        $singular_name = !empty($data['singular_name']) ? $data['singular_name'] : '';
        $name = !empty($data['name']) ? $data['name'] : '';
        $theme_name = !empty($data['theme_name']) ? $data['theme_name'] : '';
        $post_slug = !empty($data['post_type']) ? $data['post_type'] : '';
        $rewrite_slug = !empty($data['rewrite_slug']) ? $data['rewrite_slug'] : '';
        $menu_postion = !empty($data['menu_postion']) ? $data['menu_postion'] : 5;
        $menu_dashicon = !empty($data['menu_dashicon']) ? $data['menu_dashicon'] : 5;
        $supporst = !empty($data['supporst']) ? $data['supporst'] : ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'];
        $labels = [
            'name'                => _x($name, 'Post Type General Name', $theme_name),
            'singular_name'       => _x($singular_name, 'Post Type Singular Name', $theme_name),
            'menu_name'           => __($name, $theme_name),
            'parent_item_colon'   => __("Parent $singular_name", $theme_name),
            'all_items'           => __("All $name", $theme_name),
            'view_item'           => __("View $singular_name", $theme_name),
            'add_new_item'        => __("Add New $singular_name", $theme_name),
            'add_new'             => __('Add New', $theme_name),
            'edit_item'           => __("Edit $singular_name", $theme_name),
            'update_item'         => __("Update $singular_name", $theme_name),
            'search_items'        => __("Search $singular_name", $theme_name),
            'not_found'           => __('Not Found', $theme_name),
            'not_found_in_trash'  => __('Not found in Trash', $theme_name),
        ];

        // Set other options for Custom Post Type

        $args = array(
            'label'               => __($name, $theme_name),
            'description'         => __("$singular_name and reviews", $theme_name),
            'labels'              => $labels,
            'supports'            => $supporst,
            // 'taxonomies'          => array( 'genres' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => $menu_postion,
            'can_export'          => true,
            'has_archive'         => false,
            'rewrite' => array('slug' => $rewrite_slug),
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
            'menu_icon' => $menu_dashicon,

        );

        // Registering your Custom Post Type
        register_post_type($post_slug, $args);
    }

    public static function setUpTaxonomy($data)
    {
        // Taxonomy Resources
        $name = !empty($data['name']) ? $data['name'] : '';
        $taxonomy = !empty($data['taxonomy']) ? $data['taxonomy'] : '';
        $post_type = !empty($data['post_type']) ? $data['post_type'] : '';


        register_taxonomy(
            $taxonomy,
            $post_type,
            array(
                'labels' => array(
                    'name' => $name,
                    'add_new_item' => 'Add New',
                    'new_item_name' => "New $name"
                ),
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true,
                'hasArchive' => true
            )
        );
    }
}
