<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

require_once 'vendor/autoload.php';
define('codeflies_acf_path', get_template_directory(). '/app/acf/');
define('codeflies_acf_url', get_template_directory_uri() .'/app/acf/');
   require_once codeflies_acf_path.'acf.php';
	add_filter('acf/settings/url', 'codeflies_acf_settings_url');
	function codeflies_acf_settings_url($url){
		return codeflies_acf_url;
	}
// echo get_template_directory_uri();
  function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Footer Top', 'community' ),
            'id' => 'footer-1',
            'description' => __( 'Add Logo Image', 'community' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
            )
    );
    register_sidebar(
        array (
            'name' => __( 'Footer Bottom', 'community' ),
            'id' => 'footer-4',
            'description' => __( 'Add image Image', 'community' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
     register_sidebar(
        array (
            'name' => __( 'Footer Menu', 'community' ),
            'id' => 'footer-2',
            'description' => __( 'Add footer menu', 'community' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
     register_sidebar(
        array (
            'name' => __( 'Copyright', 'community' ),
            'id' => 'footer-3',
            'before_widget' => '',
			'after_widget'  => '',
            'description' => __( 'copyright content', 'community' ),
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'my_custom_sidebar' );
function community_one_setup() {
register_nav_menus(
			array(
				'Footer'  => esc_html__( 'Secondry menu', 'twentytwentyone' ),
			)
		);
        $logo_width  = 300;
		$logo_height = 100;
		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
                )
		);
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);
		}
add_action( 'after_setup_theme', 'community_one_setup' );
function custom_login() {
    // Check if the form was submitted
    if (isset($_POST['action']) && $_POST['action'] == 'custom_login') {
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];
        $user = wp_signon(array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true, // Optional: Remember the user
        ));
        // Check if the login was successful
        if (is_wp_error($user)) {
            echo "<script> 
            alert('Please fill a valid username and password.')
            window.location= '". home_url() ."';
            </script>";
            // Login failed, handle the error (e.g., display an error message)
            //wp_redirect(home_url()); // Redirect to the home page or login page
            exit;
        } else {
            // Login successful, redirect to the desired page
            wp_redirect(home_url('community')); // Redirect to the home page or any other page
            exit;
        }
    }
}
add_action('admin_post_custom_login', 'custom_login');
add_action('admin_post_nopriv_custom_login', 'custom_login');
function custom_logout_redirect() {
    wp_redirect(home_url());
    exit();
}
add_action('wp_logout', 'custom_logout_redirect');
function custom_post_type() {
    $labels = array(
        'name'               => 'HR',
        'singular_name'      => 'HR',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit',
        'new_item'           => 'New',
        'all_items'          => 'All',
        'view_item'          => 'View',
        'search_items'       => 'Search',
        'not_found'          => 'No HR found',
        'not_found_in_trash' => 'No HR found in Trash',
        'menu_name'          => 'HR'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'test_post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('community_hr', $args);
    $labels1 = array(
        'name'               => 'Sales',
        'singular_name'      => 'Sales',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit',
        'new_item'           => 'New',
        'all_items'          => 'All',
        'view_item'          => 'View',
        'search_items'       => 'Search',
        'not_found'          => 'No Sales found',
        'not_found_in_trash' => 'No Sales found in Trash',
        'menu_name'          => 'Sales'
    );
    $args1 = array(
        'labels'             => $labels1,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'test_post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('community_sales', $args1);
    $labels2 = array(
        'name'               => 'Marketing',
        'singular_name'      => 'Marketing',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit',
        'new_item'           => 'New',
        'all_items'          => 'All',
        'view_item'          => 'View',
        'search_items'       => 'Search',
        'not_found'          => 'No Marketing found',
        'not_found_in_trash' => 'No Marketing found in Trash',
        'menu_name'          => 'Marketing'
    );
    $args2 = array(
        'labels'             => $labels2,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'test_post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('community_marketing', $args2);
    $labels3 = array(
        'name'               => 'Events',
        'singular_name'      => 'Events',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit',
        'new_item'           => 'New',
        'all_items'          => 'All',
        'view_item'          => 'View',
        'search_items'       => 'Search',
        'not_found'          => 'No Events found',
        'not_found_in_trash' => 'No Events found in Trash',
        'menu_name'          => 'Events'
    );
    $args3 = array(
        'labels'             => $labels3,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'test_post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('community_events', $args3);
     $labels4 = array(
        'name'               => 'Compliance',
        'singular_name'      => 'Compliance',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit',
        'new_item'           => 'New',
        'all_items'          => 'All',
        'view_item'          => 'View',
        'search_items'       => 'Search',
        'not_found'          => 'No Compliance found',
        'not_found_in_trash' => 'No Compliance found in Trash',
        'menu_name'          => 'Compliance'
    );
    $args4 = array(
        'labels'             => $labels4,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'test_post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('community_compliance', $args4);
     $labels5 = array(
        'name'               => 'IT',
        'singular_name'      => 'IT',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New',
        'edit_item'          => 'Edit',
        'new_item'           => 'New',
        'all_items'          => 'All',
        'view_item'          => 'View',
        'search_items'       => 'Search',
        'not_found'          => 'No IT found',
        'not_found_in_trash' => 'No IT found in Trash',
        'menu_name'          => 'IT'
        );
    $args5 = array(
        'labels'             => $labels5,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'test_post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'author', 'thumbnail')
    );
    register_post_type('community_it', $args5);
}
add_action('init', 'custom_post_type');
function hide_posts_menu_for_role(){
    // $user = wp_roles();
    // print_r($user);
    $current_user = wp_get_current_user();
    $rolesList=['hr_role','sales','marketing','events','compliance','it_depart'];
    $is_true=[];
    if(!empty($current_user->roles)){
        foreach($current_user->roles as $role){
            if(in_array($role,$rolesList)){
            $is_true[]=true;
            }
        }
    }
    if(!empty($is_true)){
     remove_menu_page('edit.php');
     remove_menu_page('tools.php');
     remove_menu_page('edit.php?post_type=article');
     remove_menu_page('upload.php');
    }else{
        if( function_exists('acf_add_options_page') ) {
        // Register options page.
       acf_add_options_page(array(
            'page_title'    => __('Theme General Settings'),
            'menu_title'    => __('Theme Settings'),
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
    }
}
add_action('admin_menu', 'hide_posts_menu_for_role');
function remove_top_new_button() {
    $current_user = wp_get_current_user();
    $rolesList=['hr_role','sales','marketing','events','compliance','it_depart'];
    $is_true=[];
    if(!empty($current_user->roles)){
        foreach($current_user->roles as $role){
            if(in_array($role,$rolesList)){
            $is_true[]=true;
            }
        }
    }
    if(!empty($is_true)){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('new-content');
    $args = array(
        'id'    => 'dashboard',
        'title' => 'Dashboard',
        'href'  => get_home_url().'/wp-admin'
    );
    $wp_admin_bar->add_node($args);
}
}
add_action('wp_before_admin_bar_render', 'remove_top_new_button');

function remove_multiple_roles() {
    $roles_to_remove = array('editor', 'author', 'contributor', 'subscriber');

    foreach ($roles_to_remove as $role) {
        remove_role($role);
    }
}
add_action('init', 'remove_multiple_roles');
