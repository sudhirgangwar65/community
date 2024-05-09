<?php
// Template Name: Home Page
if (is_user_logged_in()) {
        // Replace 'your-assigned-page-slug' with the desired slug of the page you want to redirect to
        $redirect_to = home_url('/community/');
        header('Location: '.$redirect_to.'');
    }else{
        get_header();
?>
    <section class="hero_sec-new rst">
        <div class="hero-sec-first">
            <div class="hero-sec-row">
                <div class="hero-each-sec">
                    <h2><?= (!empty(get_field('nautical_title'))) ? get_field('nautical_title') : ''; ?></h2>
                    <div class="from-sale-box">
                        <div class="from-sale">
                            <div class="from-sale-inner">
                                <div class="from-sale-child">
                                    <h4><?= (!empty(get_field('nautical_subtitle'))) ? get_field('nautical_subtitle') : ''; ?></h4>
                                    <p><?= (!empty(get_field('nautical_description'))) ? get_field('nautical_description') : ''; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-each-sec">
                    <?php if(!empty(get_field('banner_image'))){ ?>
                    <img src="<?php the_field('banner_image'); ?>" alt="">
                <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <div class="hero-phone-sec">
        <h2><?= (!empty(get_field('nautical_title'))) ? get_field('nautical_title') : ''; ?></h2>
        <div class="deisgn-circle">
            <div class="design-cricle-box">
                <?php if(!empty(get_field('image1'))){ ?>
                   <img src="<?php the_field('image1'); ?>" alt="">
                <?php } ?>
                
            </div>
            <div class="design-cont-cirlle">
                <h4><?= (!empty(get_field('nautical_subtitle'))) ? get_field('nautical_subtitle') : ''; ?></h4>
                <p>
                   <?= (!empty(get_field('nautical_description'))) ? get_field('nautical_description') : ''; ?>
                </p>
            </div>
        </div>

        <div class="sale-res-img">
            <?php if(!empty(get_field('image2'))){ ?>
                   <img src="<?php the_field('image2'); ?>" alt="">
                <?php } ?>
            </div>
    </div>

    <section class="hero_sec-new second-sec-new">
        <div class="working-sec-new">
            <h2><?= (!empty(get_field('working_title'))) ? get_field('working_title') : ''; ?></h2>
            <div class="working-sec-box">
                <?php 
                    $box = get_field('working_box');
                    if(!empty($box)){
                    foreach($box as $boxitem){                
                 ?>                
                <div class="working-box-each">
                    <div class="from-sale">
                        <div class="from-sale-inner">
                            <div class="from-sale-child">
                                <h4><?= $boxitem['box_title'] ?></h4>
                                <p><?= $boxitem['box_description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php } } ?>

            </div>
        </div>
    </section>
    <section class="hero_sec-new third-sec-new">
        <div class="message-sec-new">
            <div class="message-sec-cont">
                <h2><?= (!empty(get_field('question_title'))) ? get_field('question_title') : ''; ?></h2>
                <?php 
                $btn = get_field('Qu_button');
                if(!empty($btn)){
                ?>
                <a href="<?= esc_url($btn['url']); ?>"><?= esc_html($btn['title']); ?></a>
            <?php } ?>
            </div>
            <div class="message-img">
            <img src="<?= (!empty(get_field('q_image'))) ? get_field('q_image') : ''; ?>" class="desk-img"
                alt="">
            <img src="<?= (!empty(get_field('q_image1'))) ? get_field('q_image1') : ''; ?>" class="phone-img"
                    alt="">
            </div>
        </div>
    </section>
<?php
get_footer();
}

?>