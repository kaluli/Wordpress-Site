<div class="span3 sidebar-wrap">

    <!-- Sidebar -->
    <aside class="sidebar">
        <?php
	if(function_exists('drawAdsPlace')){
                drawAdsPlace(array('id' => 2), array('before' => '<div class="ad">', 'after' => '</div>'));
        }
        if ( ! dynamic_sidebar( __('Property Sidebar','framework') )) :
        endif;
        ?>
    </aside><!-- End Sidebar -->

</div>
