<!-- Login Modal -->
<div id="login-modal" class="forms-modal modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <p><?php _e('You need to log in to use member only features.','framework');?></p>
    </div>

    <!-- start of modal body -->
    <div class="modal-body">

        <!-- login section -->
        <div class="login-section modal-section">
            <h4><?php _e('Login','framework');?></h4>
            <form id="login-form" class="login-form" action="<?php echo wp_login_url(); ?>" method="post" enctype="multipart/form-data">
                <div class="form-option">
                    <label for="username"><?php _e('User Name','framework'); ?><span>*</span></label>
                    <input id="username" name="log" type="text" class="required" title="<?php _e( '* Please provide user name!', 'framework'); ?>" autofocus required/>
                </div>
                <div class="form-option">
                    <label for="password"><?php _e('Password','framework'); ?><span>*</span></label>
                    <input id="password" name="pwd" type="password" class="required" title="<?php _e( '* Please provide password!', 'framework'); ?>" required/>
                </div>
                <?php
                if( is_singular('property') ){
                    ?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata(); global $post; the_permalink( $post->ID ); ?>" /><?php
                }else{
                    ?><input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>" /><?php
                }
                ?>
                <input type="submit" name="submit" value="<?php _e('Log in','framework');?>" class="real-btn login-btn" />
            </form>
            <p>
                <?php if( get_option('users_can_register') ) : ?>
                    <a class="activate-section" data-section="register-section" href="#"><?php _e('Register Here','framework'); ?></a>
                    <span class="divider">-</span>
                <?php endif; ?>
                <a class="activate-section" data-section="forgot-section" href="#"><?php _e('Forgot Password','framework'); ?></a>
            </p>
        </div>

        <!-- forgot section -->
        <div class="forgot-section modal-section">
            <h4><?php _e('Reset Password','framework');?></h4>
            <form action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" id="forgot-form"  method="post">
                <div class="form-option">
                    <label for="user_login"><?php _e('User Name or Email','framework'); ?><span>*</span></label>
                    <input id="user_login" name="user_login" type="text" class="required" title="<?php _e( '* Please provide user name or email!', 'framework'); ?>" required/>
                </div>
                <input type="hidden" name="user-cookie" value="1" />
                <input type="submit" name="user-submit" value="<?php _e('Reset Password','framework');?>" class="real-btn register-btn" />
            </form>
            <p>
                <a class="activate-section" data-section="login-section" href="#"><?php _e('Login Here','framework'); ?></a>
                <?php if( get_option('users_can_register') ) : ?>
                    <span class="divider">-</span>
                    <a class="activate-section" data-section="register-section" href="#"><?php _e('Register Here','framework'); ?></a>
                <?php endif; ?>
            </p>
        </div>

        <?php
        if( get_option('users_can_register') ) :
            ?>
            <!-- register section -->
            <div class="register-section modal-section">
                <h4><?php _e('Register','framework');?></h4>
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
                    <input type="submit" name="user-submit" value="<?php _e('Register','framework');?>" class="real-btn register-btn" />
                </form>
                <p>
                    <a class="activate-section" data-section="login-section" href="#"><?php _e('Login Here','framework'); ?></a>
                    <span class="divider">-</span>
                    <a class="activate-section" data-section="forgot-section" href="#"><?php _e('Forgot Password','framework'); ?></a>
                </p>
            </div>
        <?php
        endif;
        ?>

    </div>
    <!-- end of modal-body -->

</div>