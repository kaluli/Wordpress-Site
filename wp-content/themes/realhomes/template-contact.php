<?php
/*
*   Template Name: Contact Template
*/
get_header();
?>

    <!-- Page Head -->
    <?php get_template_part("banners/default_page_banner"); ?>

        <!-- Content -->
        <div class="container contents contact-page">
            <div class="row">
                <div class="span9 main-wrap">
                    <!-- Main Content -->
                    <div class="main">

                        <div class="inner-wrapper">
                            <?php
                            if ( have_posts() ) :
                                while ( have_posts() ) :
                                    the_post();
                                    ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                                        <?php the_content(); ?>
                                    </article>
                                    <?php
                                endwhile;
                            endif;

                            $show_contact_map = get_option('theme_show_contact_map');
                            if($show_contact_map == 'true'){
                                ?>
                                <div class="map-container clearfix">
                                <?php get_template_part('template-parts/contact-map'); ?>
                                </div>
                                <?php
                            }

                            $show_details = get_option('theme_show_details');
                            if($show_details == 'true'){
                                $contact_details_title = get_option('theme_contact_details_title');
                                $contact_address = stripslashes(get_option('theme_contact_address'));
                                $contact_cell = get_option('theme_contact_cell');
                                $contact_phone = get_option('theme_contact_phone');
                                $contact_fax = get_option('theme_contact_fax');
                                $contact_display_email = get_option('theme_contact_display_email');
                                ?>
                                <section class="contact-details clearfix">
                                    <?php
                                    if(!empty($contact_details_title)){
                                        ?><h3><?php echo $contact_details_title; ?></h3><?php
                                    }

                                    if(!empty($contact_address)){
                                        ?><address><?php echo $contact_address; ?></address><?php
                                    }
                                    ?>
                                    <ul class="contacts-list">
                                        <?php
                                        if(!empty($contact_phone)){
                                            ?><li class="phone"> <?php _e('Phone', 'framework'); ?>: <?php echo $contact_phone; ?></li><?php
                                        }
                                        if(!empty($contact_cell)){
                                            ?><li class="mobile"> <?php _e('Mobile', 'framework'); ?>: <?php echo $contact_cell; ?></li><?php
                                        }
                                        if(!empty($contact_fax)){
                                            ?><li class="fax"> <?php _e('Fax', 'framework'); ?>: <?php echo $contact_fax; ?></li><?php
                                        }
                                        if(!empty($contact_display_email)){
                                            ?><li class="email"> <?php _e('Email', 'framework'); ?>: <?php echo $contact_display_email; ?></li><?php
                                        }
                                        ?>
                                    </ul>
                                </section>
                                <?php
                            }

                            $theme_contact_email = get_option('theme_contact_email');
                            $contact_form_heading = get_option('theme_contact_form_heading');

                            if(!empty($theme_contact_email)){
                                ?>
                                <section id="contact-form">
                                    <?php
                                    if(!empty($contact_form_heading)){
                                        ?><h3 class="form-heading"><?php echo $contact_form_heading; ?></h3><?php
                                    }
                                    ?>

                                    <form class="contact-form" method="post" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">
                                        <p>
                                            <label for="name"><?php _e('Name', 'framework'); ?></label>
                                            <input type="text" name="name" id="name" class="required" title="<?php _e( '* Please provide your name', 'framework'); ?>">
                                        </p>

                                        <p>
                                            <label for="email"><?php _e('Email', 'framework'); ?></label>
                                            <input type="text" name="email" id="email" class="email required" title="<?php _e( '* Please provide a valid email address', 'framework'); ?>">
                                        </p>

                                        <p>
                                            <label for="subject"><?php _e('Subject', 'framework'); ?></label>
                                            <input type="text" name="subject" id="subject">
                                        </p>

                                        <p>
                                            <label for="comment"><?php _e('Message', 'framework'); ?></label>
                                            <textarea  name="message" id="comment" class="required" title="<?php _e( '* Please provide your message', 'framework'); ?>"></textarea>
                                        </p>

                                        <p>
                                            <?php
                                            /* Display recaptcha if enabled and configured from theme options */
                                            get_template_part('recaptcha/custom-recaptcha');
                                            ?>
                                        </p>

                                        <p>
                                            <input type="submit" value="<?php _e('Send Message', 'framework'); ?>" id="submit" class="real-btn" name="submit">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="contact-loader" alt="Loading...">
                                            <input type="hidden" name="action" value="send_message" />
                                            <input type="hidden" name="target" value="<?php echo antispambot( $theme_contact_email ); ?>" />
                                        </p>
                                        <div class="error-container"></div>
                                        <div id="message-sent">&nbsp;</div>
                                    </form>
                                </section>
                                <?php
                            }
                            ?>

                        </div>

                    </div><!-- End Main Content -->
                </div><!-- End span9 -->

                <?php get_sidebar('contact'); ?>

            </div><!-- End contents row -->
        </div><!-- End Content -->


<?php get_footer(); ?>