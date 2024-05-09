<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?>>
<head>
    <meta <?php bloginfo( 'charset' ); ?>>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_the_title(); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/style.css?<?= rand(10,100); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php wp_head(); ?>
</head>
<body>
    <header class="nv-new">
        <div class="nv-new-header-logo">
            <?php 
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                if ( has_custom_logo() ) { ?>
            <a href="<?= get_site_url(); ?>">
                <img src="<?= esc_url( $logo[0]); ?>" alt="">
            </a>                
                <?php } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
            ?>
           
        </div>
        <?php 
            if (!is_user_logged_in()) {
        ?>
        <div class="login-panel">
           <form method="post" id="myform" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="custom_login">
                        <div class="input-box">
                              <input type="text" name="username" placeholder="UserName" id="username">
                        </div>
                      <div class="input-box">
                        <input type="password" name="password" placeholder="Password" id="password">
                    </div>
                    
                        <input type="submit" value="Login">

                    </form>
        <?php 
            //Custom Login form 
            if (isset($_POST['submit'])) {
                $login_data = [];
                $login_data['user_login'] = sanitize_user($_POST['log']);
                $login_data['user_password'] = esc_attr($_POST['pwd']); 
                $user = wp_signon( $login_data, true );
                if ( is_wp_error( $user ) ) {
                    echo $user->get_error_message();
                }
                }
                    
        ?>
        </div>
    <?php } ?>
        <div class="nv-new-menu-icon">
            <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/menu-icn.png" alt="">
        </div>
    </header>

    <div class="desk-sidebar">
        <div class="cross">
            <img src="<?= get_site_url(); ?>/wp-content/uploads/2023/10/close-icn.png" alt="">
        </div>
        <div class="side-menus">
            <?php 
            $menu = get_field('main_menu', 'option');
            if(!empty($menu)){
                
            ?>
            <ul>
                <?php 
                    foreach($menu as $menuitem){
                        $menus = $menuitem['menu_item'];
                ?>
                <li>
                    <a href="javascript:void(0);">
                        <p><?= esc_html($menus['title']); ?></p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <?php 
                    $sub_menu = $menuitem['menu_has_child'];
                    if($sub_menu ==1){
                    ?>
                    <ul class="sub-menu-custom">
                        <?php 
                        $submenu = $menuitem['sub_menu']; 
                        if(!empty($submenu)){
                            foreach($submenu as $submenuitem){
                                $item = $submenuitem['sub_menu_item'];
                                if(!empty($item)){
                        ?>
                        <li>
                            <a href="<?= esc_url($item['url']); ?>"><?= esc_html($item['title']); ?></a>
                        </li>
                    <?php } } }?>
                        
                    </ul>
                <?php } ?>
                </li>   
                <?php } ?>            
            </ul>
        <?php }  ?>
            <div class="login-btn-res">
                <?php 
                $login = get_field('login_button', 'option');
                if(!empty($login)){
                ?>
                <a href="<?= esc_url($login['url']); ?>" data-toggle="modal" data-target="#exampleModal-login"><?= esc_html($login['title']); ?></a>
            <?php } ?>
            </div>
        </div>
    </div>

    <div class="res-header">
        <div class="res-menu">
            <?php 
                $res_menu = get_field('responsive_menu', 'option');
                if(!empty($res_menu)){
            ?>
            <img src="<?= $res_menu; ?>" alt="">
            <?php } ?>
        </div>
        <div class="res-logo">
            <?php 
                $res_logo = get_field('responsive_logo', 'option');
                if(!empty($res_logo)){
            ?>
            <img src="<?= $res_logo; ?>" alt="">
            <?php } ?>
        </div>
        <div class="res-header-design">
            <?php 
                $res_design = get_field('responsive_design', 'option');
                if(!empty($res_design)){
            ?>
            <img src="<?= $res_design; ?>" alt="">
            <?php } ?>
        </div>
    </div>


    <div class="modal fade" id="exampleModal-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty(get_field('popup_model_title', 'option'))) ? get_field('popup_model_title','option') : ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-custom">
                    <form method="post" id="myform" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="custom_login">
                        <input type="text" name="username" placeholder="UserName" id="username">
                        <input type="password" name="password" placeholder="Password" id="password">
                        <input type="submit" value="Login">
                    </form>

                    </div>
                </div>

            </div>
        </div>
    </div>