<?php
get_header();
?>
    <!-- Page Head -->
    <?php get_template_part("banners/gallery_page_banner"); ?>

    <!-- Content -->
    <div class="container contents lisitng-grid-layout">
        <div class="row">
            <div class="span12 main-wrap">

                <!-- Main Content -->
                <div class="main">

                    <section class="listing-layout">

                        <h3 class="title-heading"><?php the_title(); ?></h3>

                        <!-- Gallery Filter -->
                        <div id="filter-by" class="clearfix">
                            <a href="#" data-filter="gallery-item" class="active"><?php _e('All', 'framework'); ?></a><?php
                            $status_terms = get_terms('property-status');
                            if ( !empty($status_terms) && is_array($status_terms) )
                            {
                                foreach ($status_terms as $status_term)
                                {
                                    echo '<a href="' . get_term_link( $status_term->slug, $status_term->taxonomy ) . '" data-filter="'.$status_term->slug.'" title="' . sprintf(__('View all Properties having %s status', 'framework'), $status_term->name) . '">' . $status_term->name . '</a>';
                                }
                            }
                            ?>
                        </div>

                        <!-- Gallery Container -->
                        <div id="gallery-container">
                            <div class="<?php global $gallery_name; echo $gallery_name; ?> isotope clearfix">
                                <?php
                                // Basic Gallery Query
                                $query_args = array(
                                    'post_type' => 'property',
                                    'posts_per_page' => -1
                                );

                                // Gallery Query and Start of Loop
                                $gallery_query = new WP_Query( $query_args );
                                while ( $gallery_query->have_posts() ) :
                                    $gallery_query->the_post();

                                    // Getting list of property status terms
                                    $term_list = '';
                                    $terms =  get_the_terms( $post->ID, 'property-status' );
                                    if ( !empty($terms) && !is_wp_error( $terms ) ) :
                                        foreach( $terms as $term )
                                        {
                                            $term_list .= $term->slug;
                                            $term_list .= ' ';
                                        }
                                    endif;

                                    if(has_post_thumbnail()):
                                        ?>
                                        <div <?php post_class("gallery-item isotope-item $term_list"); ?> >
                                            <?php
                                            $image_id = get_post_thumbnail_id();
                                            $full_image_url = wp_get_attachment_url($image_id);
                                            global $gallery_image_size;
                                            $featured_image = wp_get_attachment_image_src( $image_id, $gallery_image_size );
                                            ?>
                                            <figure>
                                                <div class="media_container">
                                                    <a class="<?php echo get_lightbox_plugin_class(); ?> zoom" <?php echo generate_gallery_attribute(); ?> href="<?php echo $full_image_url; ?>" title="<?php the_title(); ?>"></a>
                                                    <a class="link" href="<?php the_permalink(); ?>"></a>
                                                </div>
                                                <?php echo '<img class="img-border" src="'.$featured_image[0].'" alt="'.get_the_title().'">'; ?>
                                            </figure>
                                            <h5 class="item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h5>
                                        </div>
                                        <?php
                                    endif;

                                endwhile;
                                ?>
                            </div>
                        </div>
                        <!-- end of gallery container -->

                    </section>

                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End contents row -->

    </div><!-- End Content -->

<?php get_footer(); ?>