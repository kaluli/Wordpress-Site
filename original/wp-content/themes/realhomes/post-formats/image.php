<?php
if ( has_post_thumbnail() ){
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_url($image_id);
    ?>
    <figure>
        <span class="format-icon image"></span>
        <a href="<?php echo $image_url; ?>" class="<?php echo get_lightbox_plugin_class(); ?>" title="<?php the_title(); ?>">
            <?php
            if( is_page_template( 'template-home.php' )){
                the_post_thumbnail('gallery-two-column-image');
            }else{
                the_post_thumbnail('post-featured-image');
            }
            ?>
        </a>
    </figure>
    <?php
}
?>