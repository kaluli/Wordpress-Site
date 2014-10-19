<?php
/*
*  Template Name: My Properties Template
*/

get_header();
?>

    <!-- Page Head -->
    <?php get_template_part("banners/default_page_banner"); ?>

    <!-- Content -->
    <div class="container contents single my-properties">
        <div class="row">
            <div class="span12 main-wrap">

                <?php
                if( isset($_GET['deleted']) && ( intval($_GET['deleted']) == 1 ) ){
                    alert( __('Success!','framework'),__('Property removed.','framework') );
                }
                ?>

                <h3><span><?php _e('My Properties List','framework'); ?></span></h3>

                <!-- Main Content -->
                <div class="main">

                    <?php
                    if(is_user_logged_in()){

                        // Get User Id
                        global $current_user;
                        get_currentuserinfo();

                        // My properties arguments
                        $my_props_args = array(
                            'post_type' => 'property',
                            'posts_per_page' => 10,
                            'paged' => $paged,
                            'post_status' => array( 'pending', 'draft', 'publish', 'future' ),
                            'author' => $current_user->ID
                        );

                        $my_properties_query = new WP_Query( $my_props_args );
                        if ( $my_properties_query->have_posts() ) :

                            /* Get Payment Related Options before while loop */
                            $payments_enabled   = get_option( 'theme_enable_paypal' );
                            $paypal_merchant_id = get_option( 'theme_paypal_merchant_id' );
                            $enable_sandbox     = get_option( 'theme_enable_sandbox' );
                            $payment_amount     = get_option( 'theme_payment_amount' );
                            $currency_code      = get_option( 'theme_currency_code' );

                            while ( $my_properties_query->have_posts() ) :
                                $my_properties_query->the_post();


                                ?>
                                <div class="my-property clearfix">

                                    <div class="property-thumb cell">
                                        <?php
                                        if(has_post_thumbnail($post->ID)){
                                            the_post_thumbnail('property-thumb-image',array(
                                                'alt'	=> get_the_title($post->ID),
                                                'title'	=> get_the_title($post->ID)
                                            ));
                                        }
                                        ?>
                                    </div>

                                    <div class="property-title cell">
                                        <h5><?php the_title(); ?></h5>
                                    </div>

                                    <div class="property-date cell">
                                        <h5><i class="fa fa-calendar"></i>&nbsp;<?php _e('Posted on :','framework');?>&nbsp;<?php the_time("d F 'y"); ?></h5>
                                    </div>

                                    <div class="property-publish-status cell">
                                        <h5><?php echo get_post_status(); ?></h5>
                                    </div>

                                    <div class="property-controls">
                                        <?php
                                        /* Edit Post Link */
                                        $submit_url = get_option('theme_submit_url');
                                        if(!empty($submit_url)){
                                            $edit_link = add_query_arg( 'edit_property', $post->ID , $submit_url );
                                            ?><a href="<?php echo $edit_link; ?>"><i class="fa fa-pencil"></i></a><?php
                                        }

                                        /* Preview Post Link */
                                        if ( current_user_can('read_private_posts') ) {
                                            $preview_link = set_url_scheme( get_permalink( $post->ID ) );
                                            $preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
                                            if(!empty($preview_link)){
                                                ?><a target="_blank" href="<?php echo $preview_link; ?>"><i class="fa fa-eye"></i></a><?php
                                            }
                                        }

                                        /* Delete Post Link Bypassing Trash */
                                        if ( current_user_can('delete_posts') ) {
                                            $delete_post_link = get_delete_post_link( $post->ID, '', true );
                                            if(!empty($delete_post_link)){
                                                ?><a href="<?php echo $delete_post_link; ?>"><i class="fa fa-times"></i></a><?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="property-payment cell">
                                        <?php
                                            if( ($payments_enabled == "true") && (!empty($paypal_merchant_id)) && (!empty($currency_code)) && (!empty($payment_amount)) ){
                                                $payment_status = get_post_meta( $post->ID, 'payment_status', true );
                                                if( $payment_status == "Completed" ) {
                                                    echo '<h5>';
                                                    _e('Payment Completed','framework');
                                                    echo '</h5>';
                                                }else{
                                                    ?>
                                                    <script src= "<?php echo get_template_directory_uri()."/js/paypal-button.min.js?merchant=$paypal_merchant_id"; ?>"
                                                            <?php
                                                            if( $enable_sandbox == "true" ){
                                                            ?>data-env="sandbox"<?php
                                                    }
                                                    ?>
                                                            data-callback="<?php echo get_template_directory_uri()."/paypal/ipn.php"; ?>"
                                                            data-tax="0"
                                                            data-shipping="0"
                                                            data-currency="<?php echo $currency_code; ?>"
                                                            data-amount="<?php echo $payment_amount; ?>"
                                                            data-quantity="1"
                                                            data-name="<?php the_title(); ?>"
                                                            data-number="<?php echo $post->ID; ?>"
                                                            data-button="buynow"
                                                        ></script>
                                                    <?php
                                                }
                                            }

                                        ?>
                                    </div>

                                </div>
                                <?php

                            endwhile;
                            wp_reset_query();
                        else:
                            ?>
                            <div class="alert-wrapper">
                                <h5><?php _e('No Properties Found!', 'framework') ?></h5>
                            </div>
                            <?php
                        endif;

                        theme_pagination( $my_properties_query->max_num_pages);

                    }else{
                        ?>
                        <div class="alert-wrapper">
                            <h5><?php _e('Please, Log in to view your properties!', 'framework') ?></h5>
                        </div>
                        <?php
                    }

                    ?>

                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End contents row -->

    </div><!-- End Content -->

<?php get_footer(); ?>