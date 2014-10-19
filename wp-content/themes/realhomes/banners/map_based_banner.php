<?php
$properties_for_map = array(
                        'post_type' => 'property',
                        'posts_per_page' => -1
                    );

if(is_page_template('template-search.php')){
    /* Apply Search Filter */
    $properties_for_map = apply_filters('real_homes_search_parameters',$properties_for_map);
}elseif(is_tax()){
    global $wp_query;
    /* Taxonomy Query */
    $properties_for_map['tax_query'] = array(
                                            array(
                                                'taxonomy' => $wp_query->query_vars['taxonomy'],
                                                'field' => 'slug',
                                                'terms' => $wp_query->query_vars['term']
                                            )
                                        );
}

$properties_for_map_query = new WP_Query( $properties_for_map );

$properties_array_string = "";
if ( $properties_for_map_query->have_posts() ) :
    while ( $properties_for_map_query->have_posts() ) :
        $properties_for_map_query->the_post();

        if(empty($properties_array_string)){
            $properties_array_string .= '{';
        }else{
            $properties_array_string .= ', {';
        }

        /* Property Title */
        $properties_array_string .= ' title:"'.get_the_title().'", ';

        /* Property Price */
        $properties_array_string .= ' price:"'.get_property_price().'", ';

        /* Property Location */
        $property_location = get_post_meta($post->ID,'REAL_HOMES_property_location',true);
        if(!empty($property_location)){
            $lat_lng = explode(',',$property_location);
            $properties_array_string .= ' lat:'.$lat_lng[0].', ';
            $properties_array_string .= ' lng:'.$lat_lng[1].', ';
        }

        /* Property Thumbnail */
        if(has_post_thumbnail()){
            $image_id = get_post_thumbnail_id();
            $image_attributes = wp_get_attachment_image_src( $image_id, 'property-thumb-image' );
            if(!empty($image_attributes[0])){
                $properties_array_string .= ' thumb:"'.$image_attributes[0].'", ';
            }
        }

        /* Property Title */
        $properties_array_string .= ' url:"'.get_permalink().'", ';

        /* Property Map Icon Based on Property Type */
        $property_type_slug = 'single-family-home'; // Default Icon Slug

        $type_terms = get_the_terms( $post->ID,"property-type" );
        if(!empty($type_terms)){
            foreach($type_terms as $typ_trm){
                $property_type_slug = $typ_trm->slug;
                break;
            }
        }

        if(file_exists(get_template_directory().'/images/map/'.$property_type_slug.'-map-icon.png')){
            $properties_array_string .= ' icon:"'.get_template_directory_uri().'/images/map/'.$property_type_slug.'-map-icon.png", ';
        }else{
            $properties_array_string .= ' icon:"'.get_template_directory_uri().'/images/map/single-family-home-map-icon.png", ';
        }

        $properties_array_string .= '} ';

    endwhile;
    wp_reset_query();
    ?>
    <script type="text/javascript">
        function initializePropertiesMap() {

            /* Properties Array */
            var properties = [
                <?php echo $properties_array_string; ?>
            ];

            /* Map Center Location - From Theme Options */
            var location_center = new google.maps.LatLng(properties[0].lat,properties[0].lng);

            var mapOptions = {
                zoom: 12,
                scrollwheel: false
            }

            var map = new google.maps.Map(document.getElementById("listing-map"), mapOptions);

            var bounds = new google.maps.LatLngBounds();

            /* Loop to generate marker and infowindow based on properties array */
            var markers = new Array();
            var info_windows = new Array();

            for (var i=0; i < properties.length; i++) {

                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(properties[i].lat,properties[i].lng),
                    map: map,
                    icon: properties[i].icon,
                    title: properties[i].title,
                    animation: google.maps.Animation.DROP
                });

                bounds.extend(markers[i].getPosition());

                info_windows[i] = new google.maps.InfoWindow({
                    content:    '<div class="map-info-window">'+
                        '<h5 class="prop-title"><a class="title-link" href="'+properties[i].url+'">'+properties[i].title+'</a></h5>'+
                        '<a class="thumb-link" href="'+properties[i].url+'"><img class="prop-thumb" src="'+properties[i].thumb+'" alt="'+properties[i].title+'"/></a>'+
                        '<p><span class="price">'+properties[i].price+'</span></p>'+
                        '<a class="know-more-link" href="'+properties[i].url+'"><?php _e('Know More','framework'); ?></a>'+
                        '</div>'
                });

                attachInfoWindowToMarker(map, markers[i], info_windows[i]);
            }

            map.fitBounds(bounds);

            /* function to attach infowindow with marker */
            function attachInfoWindowToMarker( map, marker, infoWindow ){
                google.maps.event.addListener( marker, 'click', function(){
                    infoWindow.open( map, marker );
                });
            }

        }

        google.maps.event.addDomListener(window, 'load', initializePropertiesMap);
    </script>

    <div id="map-head">
        <div id="listing-map"></div>
    </div>
    <!-- End Map Head -->

    <?php
else:
    if(is_tax()){
        get_template_part('banners/taxonomy_page_banner');
    }else{
        get_template_part('banners/default_page_banner');
    }
endif;
?>