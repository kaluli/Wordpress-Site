<?php
/*
*  Template Name: Login & Register Template
*/

get_header();
?>

    <!-- Page Head -->
    <?php get_template_part("banners/default_page_banner"); ?>

    <!-- Content -->
    <div class="container contents single login-register">
        <div class="row">
            <div class="span12 main-wrap">
                <?php $action = $_REQUEST['action'] ?>
                <?php if($action !== '' and $action == 'register'): ?>
                    <div class="success">
                        <span>Gracias por Registrase, revise su correo electrónico</span>
                    </div>
                <?php endif; ?>
                
                <h3><span><?php _e('Log in / Register','framework'); ?></span></h3>

                <!-- Main Content -->
                <div class="main">

                    <div class="inner-wrapper">
                            <?php
                            if(!is_user_logged_in()){
                                ?>

                                <div class="row-fluid">

                                    <div class="span6">

                                        <p class="info-text"><?php _e('Already a Member? Log in here.','framework'); ?></p>
                                        <form id="login-form" class="login-form" action="<?php echo wp_login_url(); ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-option">
                                                <label for="username"><?php _e('User Name','framework'); ?><span>*</span></label>
                                                <input id="username" name="log" type="text" class="required" title="<?php _e( '* Please provide user name!', 'framework'); ?>" autofocus required/>
                                            </div>
                                            <div class="form-option">
                                                <label for="password"><?php _e('Password','framework'); ?><span>*</span></label>
                                                <input id="password" name="pwd" type="password" class="required" title="<?php _e( '* Please provide password!', 'framework'); ?>" required/>
                                            </div>
                                            <input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>" />
                                            <input type="submit" name="submit" value="<?php _e('Log in','framework');?>" class="real-btn login-btn" />                                            
                                        </form>

                                        <p class="forgot-password">
                                            <a class="toggle-forgot-form" href="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>"><?php _e("Forgot password!",'framework')?></a>
                                        </p>

                                        <form action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" id="forgot-form"  method="post">
                                            <div class="form-option">
                                                <label for="user_login"><?php _e('User Name or Email','framework'); ?><span>*</span></label>
                                                <input id="user_login" name="user_login" type="text" class="required" title="<?php _e( '* Please provide user name or email!', 'framework'); ?>" required/>
                                            </div>
                                            <input type="hidden" name="user-cookie" value="1" />
                                            <input type="submit" name="user-submit" value="<?php _e('Reset Password','framework');?>" class="real-btn register-btn" />
                                        </form>
                                    </div>

                                    <div class="span6">
                                        <?php
                                        if(get_option('users_can_register')) :
                                            if( is_multisite() ){
                                                ?>
                                                <p class="info-text"><?php _e('Do not have an account? Register here','framework'); ?></p>
                                                <form action="<?php echo site_url('wp-signup.php', 'login_post') ?>" id="register-form"  method="post">

                                                    <div class="form-option">
                                                        <label for="username"><?php _e('User Name','framework'); ?><span>*</span></label>
                                                        <input id="username" name="user_name" type="text" class="required" title="<?php _e( '* Please provide user name!', 'framework'); ?>" required/>
                                                    </div>

                                                    <div class="form-option">
                                                        <label for="user_email"><?php _e('Email','framework'); ?><span>*</span></label>
                                                        <input id="user_email" name="user_email" type="text" class="email required" title="<?php _e( '* Please provide valid email address!', 'framework'); ?>" required/>
                                                    </div>

                                                    <input type="hidden" name="stage" value="validate-user-signup" />
                                                    <?php
                                                    /** This action is documented in wp-signup.php */
                                                    do_action( 'signup_hidden_fields', 'validate-user' );
                                                    ?>
                                                    <input type="hidden" value="user" name="signup_for" id="signupblog">
                                                    <input type="submit" name="submit" value="<?php _e('Register','framework');?>" class="real-btn register-btn" />
                                                </form>
                                                <?php
                                            }else{
                                                ?>
                                                <p class="info-text"><?php _e('Do not have an account? Register here','framework'); ?></p>
                                                <form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" id="register-form"  method="post">

                                                    <div class="form-option">
                                                        <label for="username"><?php _e('User Name','framework'); ?><span>*</span></label>
                                                        <input id="username" name="user_login" type="text" class="required" title="<?php _e( '* Please provide user name!', 'framework'); ?>" required/>
                                                    </div>

                                                    <div class="form-option">
                                                        <label for="user_email"><?php _e('Email','framework'); ?><span>*</span></label>
                                                        <input id="user_email" name="user_email" type="text" class="email required" title="<?php _e( '* Please provide valid email address!', 'framework'); ?>" required/>
                                                    </div>

                                                    <input type="hidden" name="user-cookie" value="1" />
                                                    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER["REQUEST_URI"].'?action=register' ?>" />
                                                    <input type="submit" name="user-submit" value="<?php _e('Register','framework');?>" class="real-btn register-btn" />
                                                </form>
                                                <?php
                                            }
                                        endif; ?>
                                    </div>

                                </div>
                                <?php
                            }else{
                                echo '<p class="text-error"><br/><br/>';
                                _e('You are already logged in!','framework');
                                echo '</p>';
                            }
                            ?>
                    </div>

                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End contents row -->

    </div><!-- End Content -->

<?php get_footer(); ?>