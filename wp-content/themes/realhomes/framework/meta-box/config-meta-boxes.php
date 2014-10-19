<?php
/**
 * File Name: config-meta-boxes.php
 *
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 *
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'REAL_HOMES_';

global $meta_boxes;

$meta_boxes = array();


// Video Meta Box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'video-meta-box',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Video Embed Code','framework'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'post' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name' => __('Video Embed Code','framework'),
            'desc' => __('If you are not using self hosted videos then please provide the video embed code and remove the width and height attributes.','framework'),
            'id'   => "{$prefix}embed_code",
            'type' => 'textarea',
            'cols' => '20',
            'rows' => '3'
        )
    )
);

// Gallery Meta Box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'gallery-meta-box',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Gallery Images','framework'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'post' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'             => __('Upload Gallery Images','framework'),
            'id'               => "{$prefix}gallery",
            'desc' => __('Images should have minimum width of 830px and minimum height of 323px, Bigger size images will be cropped automatically.','framework'),
            'type'             => 'image_advanced',
            'max_file_uploads' => 48
        )
    )
);

/* Agents */
$agents_array = array( -1 => __('None','framework') );
$agents_posts = get_posts( array( 'post_type' => 'agent', 'posts_per_page' => -1 ) );
if(!empty($agents_posts)){
    foreach( $agents_posts as $agent_post ){
        $agents_array[$agent_post->ID] =$agent_post->post_title;
    }
}

// Property Details Meta Box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'property_details',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Property Details','framework'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'property' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'      => __( 'Gallery Type', 'framework' ),
            'desc'      => __('Select the type of gallery that you want to use for this property images', 'framework'),
            'id'        => "{$prefix}gallery_slider_type",
            'type'      => 'radio',
            'std'       => 'thumb-on-right',
            'options' => array(
                'thumb-on-right' => __( 'Gallery with thumbnails on right', 'framework' ),
                'thumb-on-bottom' => __( 'Gallery with thumbnails on bottom', 'framework' )
            )
        ),
        array(
            'name'             => __('Property Gallery Images','framework'),
            'id'               => "{$prefix}property_images",
            'desc' => __('Provide images for gallery on property detail page. Images should have minimum size of 770px by 386px for thumbnails on right and 830px by 460px for thumbnails on bottom. ( Bigger images will be cropped automatically )','framework'),
            'type'             => 'image_advanced',
            'max_file_uploads' => 48
        ),
        array(
            'id'        => "{$prefix}property_price",
            'name'      => __('Property Price','framework'),
            'desc'      => __('Provide Sale OR Rent Price. ( Plesae only provide digits ) Example Value: 435000','framework'),
            'type'      => 'text',
            'std'       => ""
        ),
        array(
            'id'        => "{$prefix}property_price_postfix",
            'name'      => __('Price Postfix Text','framework'),
            'desc'      => __('Text provided here will appear after price. ( You can also leave it empty ) Example Value: Per Month','framework'),
            'type'      => 'text',
            'std'       => ""
        ),
        array(
            'id'        => "{$prefix}property_size",
            'name'      => __('Property Size','framework'),
            'desc'      => __('Provide size ( Please only provide digits ) Example Value: 2500','framework'),
            'type'      => 'text',
            'std'       => ""
        ),
        array(
            'id'        => "{$prefix}property_size_postfix",
            'name'      => __('Size Postfix Text','framework'),
            'desc'      => __('Text provided here will appear after size. ( You can also leave it empty ) Example Value: Sq Ft','framework'),
            'type'      => 'text',
            'std'       => ""
        ),
        array(
            'id'        => "{$prefix}property_address",
            'name'      => __('Property Address','framework'),
            'desc'      => __('Provide property address.','framework'),
            'type'      => 'text',
            'std'       => '1903 Hollywood Boulevard, Hollywood, FL 33020, USA'
        ),
        array(
            'id'            => "{$prefix}property_location",
            'name'          => __('Property Location at Google Map*','framework'),
            'desc'          => __('Drag the google map marker to point your property location. You can also use the address field above to search for your property.','framework'),
            'type'          => 'map',
            'std'           => '26.011812,-80.14524499999999,15',   // 'latitude,longitude[,zoom]' (zoom is optional)
            'style'         => 'width: 600px; height: 400px',
            'address_field' => "{$prefix}property_address",         // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
        ),
        array(
            'id'        => "{$prefix}tour_video_url",
            'name'      => __('Virtual Tour Video URL','framework'),
            'desc'      => __('Provide virtual tour video URL. Theme supports YouTube, Vimeo, SWF File and MOV File','framework'),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Virtual Tour Video Image','framework'),
            'id'        => "{$prefix}tour_video_image",
            'desc'      => __('Provide the image that will be displayed as place holder and when a user clicks over it the video will be opened in a lightbox. You must provide this image as otherwise the video will not be displayed on property details page. Image should have minimum width of 818px and minimum height 417px. Bigger size images will be cropped automatically.','framework'),
            'type'      => 'image_advanced',
            'max_file_uploads' => 1
        ),
        array(
            'name'	    => __('Mark this Property as Featured', 'framework'),
            'desc'      => __('Marking this property featured will display it in featured properties sections across the theme.', 'framework'),
            'id'		=> "{$prefix}featured",
            'type'		=> 'checkbox',
            'std'		=> 1
        ),
        array(
            'name'      => __( 'Add in Homepage Slider', 'framework' ),
            'desc'      => __('Do you want to add this property in Homepage Slider ? If Yes, Then you also need to provide slider image below.', 'framework'),
            'id'        => "{$prefix}add_in_slider",
            'type'      => 'radio',
            'std'       => 'no',
            'options' => array(
                'yes' => __( 'Yes ', 'framework' ),
                'no' => __( 'No', 'framework' )
            )
        ),
        array(
            'name'      => __('Slider Image','framework'),
            'id'        => "{$prefix}slider_image",
            'desc'      => __('Provide the image that will be displayed in Homepage Slider. The recommended image size is 2000px by 700px. You can use bigger or little smaller image but try to keep the same height to width ratio and use the exactly same size images for all properties that will be added in slider.','framework'),
            'type'      => 'image_advanced',
            'max_file_uploads' => 1
        ),
        array(
            'name'      => __( 'What to display in agent information box ?', 'framework' ),
            'desc'      => __('You need to select an agent from select box below, If you are choosing to display an agent\'s information', 'framework'),
            'id'        => "{$prefix}agent_display_option",
            'type'      => 'radio',
            'std'       => 'none',
            'options' => array(
                'none' => __( 'None', 'framework' ),
                'my_profile_info' => __( 'Author profile information', 'framework' ),
                'agent_info' => __( 'Display agent\'s Information', 'framework' )
            )
        ),
        /* Agents */
        array(
            'name'    => __( 'Agent', 'framework' ),
            'id'      => "{$prefix}agents",
            'desc'      => __('Please select related Agent.','framework'),
            'type' => 'select',
            'options' => $agents_array
        ),
        array(
            'id'        => "{$prefix}attachments",
            'name'      => __('Attachments','framework'),
            'desc'      => __('You can attach PDF files, Map images OR other documents to provide further details related to property.','framework'),
            'type'      => 'file_advanced',
            'mime_type' => ''
        )
    )
);

// Property Additional Details Meta Box
$meta_boxes[] = array(
    'id' => 'additonal_details',
    'title' => __('Additional Details','framework'),
    'pages' => array( 'property' ),
    'context' => 'normal',
    'priority' => 'core',
    'fields' => array(
        array(
            'id'        => "{$prefix}detail_titles",
            'name'      => __('Titles','framework'),
            'type'      => 'text',
            'std'       => "",
            'clone' => true
        ),
        array(
            'id'        => "{$prefix}detail_values",
            'name'      => __('Values','framework'),
            'type'      => 'text',
            'std'       => "",
            'clone'     => true
        )
    )
);


// Partners Meta Box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'partners-meta-box',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Featured Patners Meta','framework'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'partners' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'             => __('Partner Url','framework'),
            'id'               => "{$prefix}partner_url",
            'desc' => __('Paste here Partner Website link','framework'),
            'type'             => 'text',
        )
    )
);




// Agent Meta Box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'agent-meta-box',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Provide Related Information','framework'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'agent' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'      => __('Email Address','framework'),
            'id'        => "{$prefix}agent_email",
            'desc'      => __("Provide Agent's Email Address. Agent related messages from contact form on property details page, will be sent on this email address.","framework"),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Mobile Number','framework'),
            'id'        => "{$prefix}mobile_number",
            'desc'      => __("Provide Agent's mobile number","framework"),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Office Number','framework'),
            'id'        => "{$prefix}office_number",
            'desc'      => __("Provide Agent's office number","framework"),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Fax Number','framework'),
            'id'        => "{$prefix}fax_number",
            'desc'      => __("Provide Agent's fax number","framework"),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Facebook URL','framework'),
            'id'        => "{$prefix}facebook_url",
            'desc'      => __("Provide Agent's Facebook URL","framework"),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Twitter URL','framework'),
            'id'        => "{$prefix}twitter_url",
            'desc'      => __("Provide Agent's Twitter URL","framework"),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Google Plus URL','framework'),
            'id'        => "{$prefix}google_plus_url",
            'desc'      => __("Provide Agent's Google Plus URL","framework"),
            'type'      => 'text'
        ),
        array(
            'name'      => __('LinkedIn URL','framework'),
            'id'        => "{$prefix}linked_in_url",
            'desc'      => __("Provide Agent's LinkedIn URL","framework"),
            'type'      => 'text'
        )
    )
);


// Banner Meta Box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'banner-meta-box',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Top Banner Area Settings','framework'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'page','agent' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',

    // List of meta fields
    'fields' => array(
        array(
            'name'      => __('Banner Title','framework'),
            'id'        => "{$prefix}banner_title",
            'desc'      => __('Please provide the Banner Title, Otherwise the Page Title will be displayed in its place.','framework'),
            'type'      => 'text'
        ),
        array(
            'name'      => __('Banner Sub Title','framework'),
            'id'        => "{$prefix}banner_sub_title",
            'desc'      => __('Please provide the Banner Sub Title.','framework'),
            'type'      => 'textarea',
            'cols'      => '20',
            'rows'      => '2'
        ),
        array(
            'name'      => __('Banner Image','framework'),
            'id'        => "{$prefix}page_banner_image",
            'desc'      => __('Please upload the Banner Image. Otherwise the default banner image from theme options will be displayed.','framework'),
            'type'      => 'image_advanced',
            'max_file_uploads' => 1
        ),
        array(
            'name'      => __('Revolution Slider Alias','framework'),
            'id'        => "{$prefix}rev_slider_alias",
            'desc'      => __('If you want to replace banner with revolution slider then provide its alias here.','framework'),
            'type'      => 'text'
        )
    )
);

// Property Banner Meta Box
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'property-banner-meta-box',

    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __('Top Banner','framework'),

    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'property' ),

    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',

    // Order of meta box: high (default), low. Optional.
    'priority' => 'core',

    // List of meta fields
    'fields' => array(
        array(
            'name'      => __('Banner Image','framework'),
            'id'        => "{$prefix}page_banner_image",
            'desc'      => __('Please upload the Banner Image. Otherwise the default banner image from theme options will be displayed.','framework'),
            'type'      => 'image_advanced',
            'max_file_uploads' => 1
        )
    )
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function REAL_HOMES_register_meta_boxes()
{
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;

    global $meta_boxes;
    $meta_boxes = apply_filters('framework_theme_meta',$meta_boxes);
    foreach ( $meta_boxes as $meta_box ){
        new RW_Meta_Box( $meta_box );
    }
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'REAL_HOMES_register_meta_boxes' );

?>