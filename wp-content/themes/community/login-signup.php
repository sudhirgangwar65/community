<?php /* Template Name: Login Template */

get_header(); ?>

<section class="community-centre">
        <div class="community_banner">
            <h2>LOG IN</h2>
        </div>
        <div class="community-login">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-img">
                        <img src="https://html.localserverpro.com/NV_Community/assets/images/Group-picc.png" alt="">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="login-from-sec">
                        <h3>Log In to all access</h3>
                         <form method="post" id="myform" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="custom_login">
                        <input type="text" name="username" placeholder="UserName" id="username">
                        <input type="password" name="password" placeholder="Password" id="password">
                        <br>
                        <input type="submit" value="Login">
                    </form>
                    </div>
                </div>

            </div>
        </div>

    </section>

<?php get_footer(); ?>