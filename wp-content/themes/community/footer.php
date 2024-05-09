<section class="custom-divider">

    </section>
<footer>
        <div class="new-custom-footer">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>           
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <?php dynamic_sidebar( 'footer-2' ); ?>           
            <?php endif; ?>
            <div class="top-100">
               <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                <?php dynamic_sidebar( 'footer-4' ); ?>           
            <?php endif; ?>
            </div>
        </div>
        <div class="sub-footer">
             <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <?php dynamic_sidebar( 'footer-3' ); ?>           
            <?php endif; ?>
        </div>
    </footer>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/local.js?<?= rand(10,100); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script>
        $("#myform").validate({
                    rules: {
                         username: {
                               required: true,
                              },
                         password: {
                              required: true
                         }
                    },
                    messages: {
                            username: {
                                required: "Please enter your username."
                            },
                            password: {
                                required: "Please enter your password."
                            }
                        }
               });
    </script>
    <?php wp_footer(); ?>
</body>
</html>