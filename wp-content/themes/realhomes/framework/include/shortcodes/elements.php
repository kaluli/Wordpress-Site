<?php
/* ------------------------------------------------------------------------*
 * Messages Shortcode
 * ------------------------------------------------------------------------*/
 
 // Information
if( !function_exists( 'show_info' ) ){
    function show_info($atts, $content = null) {
        return '<p class="info">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('info', 'show_info');

// Tip
if( !function_exists( 'show_tip' ) ){
    function show_tip($atts, $content = null) {
        return '<p class="tip">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('tip', 'show_tip');
 
 // Error
if( !function_exists( 'show_error' ) ){
    function show_error($atts, $content = null) {
        return '<p class="error">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('error', 'show_error');

 // Success
if( !function_exists( 'show_success' ) ){
    function show_success($atts, $content = null) {
        return '<p class="success">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('success', 'show_success');



/* ------------------------------------------------------------------------*
 * Lists
 * ------------------------------------------------------------------------*/
// Disc list
if( !function_exists( 'disc_list' ) ){
    function disc_list($atts, $content = null) {
        return '<div class="disc-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('disc_list', 'disc_list');

// small arrow list
if( !function_exists( 'small_arrow_list' ) ){
    function small_arrow_list($atts, $content = null) {
        return '<div class="small-arrow-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('small_arrow_list', 'small_arrow_list');

// Tick list
if( !function_exists( 'tick_list' ) ){
    function tick_list($atts, $content = null) {
        return '<div class="tick-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('tick_list', 'tick_list');

// Arrow list
if( !function_exists( 'arrow_list' ) ){
    function arrow_list($atts, $content = null) {
        return '<div class="arrow-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('arrow_list', 'arrow_list');


/* ------------------------------------------------------------------------*
 * Buttons
 * ------------------------------------------------------------------------*/

// Button Real Mini
if( !function_exists( 'button_real_mini' ) ){
    function button_real_mini($atts, $content = null) {
        extract(shortcode_atts(array(
                                    'link' => '#',
                                    'target' => ''
                                    ), $atts));

        return '<a class="real-btn btn-mini" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_mini', 'button_real_mini');


// Button Real Small
if( !function_exists( 'button_real_small' ) ){
    function button_real_small($atts, $content = null) {

        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));

        return '<a class="real-btn btn-small" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_small', 'button_real_small');


// Button Real Large
if( !function_exists( 'button_real_large' ) ){
    function button_real_large($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="real-btn btn-large" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_large', 'button_real_large');



// Button blue Mini
if( !function_exists( 'button_blue_mini' ) ){
    function button_blue_mini($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-blue btn-mini" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_blue_mini', 'button_blue_mini');


// Button blue Small
if( !function_exists( 'button_blue_small' ) ){
    function button_blue_small($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-blue btn-small" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_blue_small', 'button_blue_small');


// Button blue Large
if( !function_exists( 'button_blue_large' ) ){
    function button_blue_large($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-blue btn-large" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_blue_large', 'button_blue_large');


// Button grey Mini
if( !function_exists( 'button_grey_mini' ) ){
    function button_grey_mini($atts, $content = null){
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-grey btn-mini" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_grey_mini', 'button_grey_mini');


// Button grey Small
if( !function_exists( 'button_grey_small' ) ){
    function button_grey_small($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-grey btn-small" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_grey_small', 'button_grey_small');


// Button grey Large
if( !function_exists( 'button_grey_large' ) ){
    function button_grey_large($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-grey btn-large" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_grey_large', 'button_grey_large');


?>