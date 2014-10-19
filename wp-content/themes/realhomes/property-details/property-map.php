<?php
$display_google_map = get_option('theme_display_google_map');
$display_social_share = get_option('theme_display_social_share');
if($display_google_map == 'true' || $display_social_share == 'true'){
global $post;

    ?>
    <div class="map-wrap clearfix">
        <?php
            $property_location = get_post_meta($post->ID,'REAL_HOMES_property_location',true);

            if(!empty($property_location) && $display_google_map == 'true')
            {

                $lat_lng = explode(',',$property_location);

                /* Property Map Icon Based on Property Type */
                $property_type_slug = 'single-family-home'; // Default Icon Slug
                $property_marker_icon = '';

                $type_terms = get_the_terms( $post->ID,"property-type" );
                if(!empty($type_terms)){
                    foreach($type_terms as $typ_trm){
                        $property_type_slug = $typ_trm->slug;
                        break;
                    }
                }

                if( file_exists( get_template_directory().'/images/map/'.$property_type_slug.'-map-icon.png' ) ){
                    $property_marker_icon = get_template_directory_uri().'/images/map/'.$property_type_slug.'-map-icon.png';
                }else{
                    $property_marker_icon = get_template_directory_uri().'/images/map/single-family-home-map-icon.png';
                }

                $property_map_title = get_option('theme_property_map_title');
                if( !empty($property_map_title) ){
                    ?><span class="map-label"><?php echo $property_map_title; ?></span><?php
                }
                ?>
                <div id="property_map"></div>
                <script>
                    /* Property Detail Page - Google Map for Property Location */

                    function initialize_property_map(){
                        var propertyLocation = new google.maps.LatLng(<?php echo $lat_lng[0]; ?>,<?php echo $lat_lng[1]; ?>);
                        var propertyMapOptions = {
                            center: propertyLocation,
                            zoom: 15,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            scrollwheel: false
                        };
                        var propertyMap = new google.maps.Map(document.getElementById("property_map"), propertyMapOptions);
                        var propertyMarker = new google.maps.Marker({
                            position: propertyLocation,
                            map: propertyMap,
                            icon: "<?php echo $property_marker_icon; ?>"
                        });
                    }

                    window.onload = initialize_property_map();
                </script>

                <?php
            }

            if($display_social_share == 'true'){
                ?>
                <div class="share-networks clearfix">
                    <span class="share-label"><?php _e('Share this', 'framework'); ?></span>
                    <span><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook fa-lg"></i><?php _e('Facebook','framework'); ?></a></span>
                    <span><a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" ><i class="fa fa-twitter fa-lg"></i><?php _e('Twitter','framework'); ?></a></span>
                    <span><a target="_blank" href="https://plus.google.com/share?url={<?php the_permalink(); ?>}" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes')"><i class="fa fa-google-plus fa-lg"></i><?php _e('Google','framework'); ?></a></span>
                </div>
                <?php
            }
        ?>

    </div>

    <?php
}
?>