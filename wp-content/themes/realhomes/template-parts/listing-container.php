<div class="container contents lisitng-grid-layout">
    <div class="row">
        <div class="span9 main-wrap">

            <!-- Main Content -->
            <div class="main">

                <section class="listing-layout">

                    <h3 class="title-heading"><?php the_title(); ?></h3>

                    <div class="view-type clearfix">
                        <?php
                        $page_permalink = get_permalink($post->ID);
                        $separator = (parse_url($page_permalink, PHP_URL_QUERY) == NULL) ? '?' : '&';
                        ?>
                        <a class="list active" href="<?php echo $page_permalink.$separator.'view=list'; ?>"></a>
                        <a class="grid" href="<?php echo $page_permalink.$separator.'view=grid'; ?>"></a>
                    </div>

                    <div class="list-container clearfix">
                        <?php
                        get_template_part('template-parts/sort-controls');

                        $number_of_properties = intval(get_option('theme_number_of_properties'));
                        if(!$number_of_properties){
                            $number_of_properties = 6;
                        }

                        global $paged;
                        if ( is_front_page()  ) {
                            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                        }

                        $property_listing_args = array(
                                                        'post_type' => 'property',
                                                        'posts_per_page' => $number_of_properties,
                                                        'paged' => $paged
                                                    );

                        $property_listing_args = sort_properties($property_listing_args);

                        $property_listing_query = new WP_Query( $property_listing_args );

                        if ( $property_listing_query->have_posts() ) :
                            while ( $property_listing_query->have_posts() ) :
                                $property_listing_query->the_post();

                                /* Display Property for Listing */
                                get_template_part('template-parts/property-for-listing');

                            endwhile;
                            wp_reset_query();
                        else:
                            ?>
                            <div class="alert-wrapper">
                                <h4><?php _e('Sorry No Results Found', 'framework') ?></h4>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>

                    <?php theme_pagination( $property_listing_query->max_num_pages); ?>

                </section>

            </div><!-- End Main Content -->

        </div> <!-- End span9 -->

        <?php get_sidebar('property-listing'); ?>

    </div><!-- End contents row -->
</div>