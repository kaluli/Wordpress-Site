<?php
/*
*   Template Name: Home Template
*/
get_header();


/* Theme Home Page Module */
$theme_homepage_module = get_option('theme_homepage_module');

/* For demo purpose only */
if(isset($_GET['module'])){
    $theme_homepage_module = $_GET['module'];
}

switch($theme_homepage_module){
    case 'properties-slider':
        get_template_part('template-parts/slider');
        break;

    case 'slides-slider':
        get_template_part('template-parts/separate-slider');
        break;

    case 'properties-map':
        get_template_part('banners/map_based_banner');
        break;

    case 'revolution-slider':
        $rev_slider_alias = trim(get_option('theme_rev_alias'));
        if( function_exists('putRevSlider') && (!empty($rev_slider_alias)) ){
            putRevSlider( $rev_slider_alias );
        }else{
            get_template_part('banners/default_page_banner');
        }
        break;

    default:
        get_template_part('banners/default_page_banner');
        break;
}

?>

    <!-- Content -->
    <div class="container contents">
        <div class="row">

            <div class="span12">

                <!-- Main Content -->
                <div class="main">
                    <?php
                    if ( is_active_sidebar( 'home-search-area' ) ) :
                        dynamic_sidebar( 'home-search-area' );
                    else:
                        /* Advance Search Form for Homepage */
                        get_template_part('template-parts/advance-search');
                    endif;

                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            $content = get_the_content('');
                            if(!empty($content)){
                                ?>
                                <div class="inner-wrapper">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                                        <?php the_content(); ?>
                                    </article>
                                </div>
                                <?php
                            }
                        endwhile;
                    endif;

                    ?>

                    <section class="property-items">

                        <?php
                        /* Slogan Title and Text */
                        $slogan_title = get_option('theme_slogan_title');
                        $slogan_text = get_option('theme_slogan_text');

                        ?>
                        <div class="narrative">
                            <?php
                            if(!empty($slogan_title)){
                                ?><h2><?php echo $slogan_title; ?></h2><?php
                            }

                            if(!empty($slogan_text)){
                                ?><p><?php echo $slogan_text; ?></p><?php
                            }
                            ?>
                        </div>

                        <div class="property-items-container clearfix">
                            <?php
                            /* List of Properties on Homepage */
                            $number_of_properties = intval(get_option('theme_properties_on_home'));
                            if(!$number_of_properties){
                                $number_of_properties = 4;
                            }

                            if ( is_front_page()  ) {
                                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                            }

                            $home_args = array(
                                'post_type' => 'property',
                                'posts_per_page' => $number_of_properties,
                                'paged' => $paged
                            );

                            /* Modify home query arguments based on theme options */
                            $home_properties = get_option('theme_home_properties');
                            if(!empty($home_properties) && ($home_properties == 'based-on-selection') ){

                                $types_for_homepage = get_option('theme_types_for_homepage');
                                $statuses_for_homepage = get_option('theme_statuses_for_homepage');
                                $cities_for_homepage = get_option('theme_cities_for_homepage');

                                $tax_query = array();

                                if(!empty($types_for_homepage) && is_array($types_for_homepage)){
                                    $tax_query[] = array(
                                        'taxonomy' => 'property-type',
                                        'field' => 'slug',
                                        'terms' => $types_for_homepage
                                    );
                                }

                                if(!empty($statuses_for_homepage) && is_array($statuses_for_homepage)){
                                    $tax_query[] = array(
                                        'taxonomy' => 'property-status',
                                        'field' => 'slug',
                                        'terms' => $statuses_for_homepage
                                    );
                                }

                                if(!empty($cities_for_homepage) && is_array($cities_for_homepage)){
                                    $tax_query[] = array(
                                        'taxonomy' => 'property-city',
                                        'field' => 'slug',
                                        'terms' => $cities_for_homepage
                                    );
                                }

                                $tax_count = count( $tax_query );   // count number of taxonomies
                                if( $tax_count > 1 ){
                                    $tax_query['relation'] = 'AND';  // add OR relation if more than one
                                }
                                if( $tax_count > 0 ){
                                    $home_args['tax_query'] = $tax_query;   // add taxonomies query to home query arguments
                                }
                            }elseif(!empty($home_properties) && ($home_properties == 'featured')) {

                                /* Featured Properties on Homepage */
                                    $home_args['meta_query'] = array(
                                        array(
                                            'key' => 'REAL_HOMES_featured',
                                            'value' => 1,
                                            'compare' => '=',
                                            'type'  => 'NUMERIC'
                                        ));
                            }else {

                                /* Exclude Featured Properties if enabled */
                                $featured_properties = get_option('theme_exclude_featured_properties');
                                if(!empty($featured_properties) && $featured_properties == 'true'){
                                    $home_args['meta_query'] = array(
                                        array(
                                            'key' => 'REAL_HOMES_featured',
                                            'value' => 0,
                                            'compare' => '=',
                                            'type'  => 'NUMERIC'
                                        ));
                                }
                            }


                            $sorty_by = get_option('theme_sorty_by');
                            if( !empty($sorty_by) ){
                                if( $sorty_by == 'low-to-high' ){
                                    $home_args['orderby'] = 'meta_value_num';
                                    $home_args['meta_key'] = 'REAL_HOMES_property_price';
                                    $home_args['order'] = 'ASC';
                                }elseif( $sorty_by == 'high-to-low' ){
                                    $home_args['orderby'] = 'meta_value_num';
                                    $home_args['meta_key'] = 'REAL_HOMES_property_price';
                                    $home_args['order'] = 'DESC';
                                }
                            }

                            $home_properties_query = new WP_Query( $home_args );
                            if ( $home_properties_query->have_posts() ) :
                                $post_count = 0;
                                while ( $home_properties_query->have_posts() ) :
                                    $home_properties_query->the_post();

                                    /* Display Property for Home Page */
                                    get_template_part('template-parts/property-for-home');

                                    $post_count++;
                                    if(0 == ($post_count % 2)){
                                        echo '<div class="clearfix"></div>';
                                    }
                                endwhile;
                                wp_reset_query();
                            else:
                                ?>
                                <div class="alert-wrapper">
                                    <h4><?php _e('No Properties Found!', 'framework') ?></h4>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>

                        <?php theme_pagination( $home_properties_query->max_num_pages); ?>

                    </section>

                    <?php
                    /* Featured Properties */
                    $show_featured_properties = get_option('theme_show_featured_properties');
                    if($show_featured_properties == 'true'){
                        get_template_part("template-parts/carousel") ;
                    }

                    /* Blog Posts */
                    $show_news_posts = get_option('theme_show_news_posts');
                    /* For demo purpose only */
                    if(isset($_GET['news-on-home'])){
                        $show_news_posts = $_GET['news-on-home'];
                    }
                    if($show_news_posts == 'true'){
                        get_template_part("template-parts/home-news-posts") ;
                    }
                    ?>
                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End  row -->

    </div><!-- End content -->

<?php get_footer(); ?>