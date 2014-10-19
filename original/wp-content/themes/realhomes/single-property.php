<?php
get_header();

        // Banner Image
        $banner_image_path = "";
        $banner_image_id = get_post_meta( $post->ID, 'REAL_HOMES_page_banner_image', true );
        if( $banner_image_id ){
            $banner_image_path = wp_get_attachment_url($banner_image_id);
        }else{
            $banner_image_path = get_default_banner();
        }
        ?>

        <div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo $banner_image_path; ?>'); background-size: cover;">
            <?php if(!('true' == get_option('theme_banner_titles'))): ?>
            <div class="container">
                <div class="wrap clearfix">
                    <h1 class="page-title"><span><?php _e('Property Details', 'framework'); ?></span></h1>
                    <p><?php
                        the_title();

                        if( !function_exists('display_parent_locations') ){
                            function display_parent_locations($ct_trm){
                                if( !empty($ct_trm->parent) ){
                                    $parent_location = get_term( $ct_trm->parent, 'property-city' );
                                    echo ' - '. $parent_location->name;
                                    display_parent_locations($parent_location); // recursive call
                                }
                            }
                        }

                        /* Property City */
                        $city_terms = get_the_terms( $post->ID,"property-city" );
                        if(!empty($city_terms)){
                            foreach($city_terms as $ct_trm){
                                echo ' - '. $ct_trm->name;
                                display_parent_locations($ct_trm);
                                break;
                            }
                        }
                        ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div><!-- End Page Head -->

        <!-- Content -->
        <div class="container contents detail">
            <div class="row">
                <div class="span9 main-wrap">

                    <!-- Main Content -->
                    <div class="main">

                        <div id="overview">
                         <?php
                         if ( have_posts() ) :
                             while ( have_posts() ) :
                                the_post();

                                /*
                                * 1. Property Images Slider
                                */
                                 $gallery_slider_type = get_post_meta($post->ID, 'REAL_HOMES_gallery_slider_type', true);
                                 /* For demo purpose only */
                                 if(isset($_GET['slider-type'])){
                                     $gallery_slider_type = $_GET['slider-type'];
                                 }
                                 if( $gallery_slider_type == 'thumb-on-bottom' ){
                                     get_template_part('property-details/property-slider-two');
                                 }else{
                                     get_template_part('property-details/property-slider');
                                 }


                                /*
                                * 2. Property Information Bar, Icons Bar, Text Contents and Features
                                */
                                get_template_part('property-details/property-contents');

                                /*
                                * 3. Property Video
                                */
                                get_template_part('property-details/property-video');

                                 /*
                                 * 4. Property Map
                                 */
                                 get_template_part('property-details/property-map');

                                 /*
                                 * 5. Property Attachments
                                 */
                                 get_template_part('property-details/property-attachments');

                                 /*
                                 * 6. Child Properties
                                 */
                                 get_template_part('property-details/property-children');

                                 /*
                                 * 7. Property Agent
                                 */
                                 $theme_property_detail_variation = get_option('theme_property_detail_variation');
                                 /* For demo purpose only */
                                 if(isset($_GET['variation'])){
                                     $theme_property_detail_variation = $_GET['variation'];
                                 }
                                 if( $theme_property_detail_variation != "agent-in-sidebar" ){
                                    get_template_part('property-details/property-agent');
                                 }

                             endwhile;
                         endif;
                         ?>
                        </div>

                    </div><!-- End Main Content -->

                    <?php
                    /*
                     * 8. Similar Properties
                     */
                    get_template_part('property-details/similar-properties');
                    ?>

                </div> <!-- End span9 -->

                <?php
                if( $theme_property_detail_variation == "agent-in-sidebar" ) {
                    ?>
                    <div class="span3 sidebar-wrap">
                        <!-- Sidebar -->
                        <aside class="sidebar">
                            <?php get_template_part('property-details/property-agent-for-sidebar'); ?>
                        </aside>
                        <!-- End Sidebar -->
                    </div>
                    <?php
                }else{
                    get_sidebar('property');
                }
                ?>

            </div><!-- End contents row -->
        </div><!-- End Content -->

<?php get_footer(); ?>