<?php
$display_agent_info = get_option('theme_display_agent_info');
$agent_display_option = get_post_meta($post->ID, 'REAL_HOMES_agent_display_option',true);

if( ($display_agent_info == 'true') && ($agent_display_option != "none") ){
    $property_title = get_the_title($post->ID);
    $property_permalink = get_permalink($post->ID);

    $display_author = false; // flag to display author info instead of agent info
    $hide_info_box = true;

    if($agent_display_option == "my_profile_info"){
        $display_author = true;
        $hide_info_box = false;

        $agent_mobile = get_the_author_meta('mobile_number');
        $agent_office_phone = get_the_author_meta('office_number');
        $agent_office_fax = get_the_author_meta('fax_number');
        $agent_email = get_the_author_meta('user_email');

        $agent_title_text = __('Submitted by','framework')." ".get_the_author_meta('display_name');

    }else{
        $property_agent = get_post_meta($post->ID, 'REAL_HOMES_agents',true);
        if( ( !empty($property_agent) ) && ( intval($property_agent) > 0 ) ){
            $hide_info_box = false;

            $agent_id = intval($property_agent);
            $post = get_post($agent_id);
            setup_postdata($post);

            $agent_mobile = get_post_meta($agent_id, 'REAL_HOMES_mobile_number',true);
            $agent_office_phone = get_post_meta($agent_id, 'REAL_HOMES_office_number',true);
            $agent_office_fax = get_post_meta($agent_id, 'REAL_HOMES_fax_number',true);
            $agent_email = get_post_meta($agent_id, 'REAL_HOMES_agent_email',true);

            $agent_title_text = __('Agent','framework')." ".get_the_title($agent_id);
            $agent_description = get_framework_excerpt(18);

            wp_reset_postdata();
        }
    }


    if( !$hide_info_box ){
        ?>
        <div class="agent-detail clearfix">

            <div class="left-box">
                <h3><?php echo $agent_title_text ?></h3>
                <?php
                if($display_author){
                    if(function_exists('get_avatar')) {
                        ?><figure><?php echo get_avatar( $agent_email, '210' ); ?></figure><?php
                    }
                }else{
                    if(has_post_thumbnail($agent_id)){
                        ?><figure><a href="<?php echo get_permalink($agent_id); ?>"><?php echo get_the_post_thumbnail( $agent_id, 'agent-image'); ?></a></figure><?php
                    }
                }
                ?>
                <ul class="contacts-list">
                    <?php
                    if(!empty($agent_office_phone)){
                        ?><li class="office"><?php _e('Office', 'framework'); ?> : <?php echo $agent_office_phone; ?></li><?php
                    }
                    if(!empty($agent_mobile)){
                        ?><li class="mobile"><?php _e('Mobile', 'framework'); ?> : <?php echo $agent_mobile; ?></li><?php
                    }
                    if(!empty($agent_office_fax)){
                        ?><li class="fax"><?php _e('Fax', 'framework'); ?>  : <?php echo $agent_office_fax; ?></li><?php
                    }
                    ?>
                </ul>
                <p>
                    <?php
                    if($display_author){
                        the_author_meta('description');
                    }else{
                        echo $agent_description;
                        ?>
                        <br/>
                        <a class="real-btn" href="<?php echo get_permalink($agent_id); ?>"><?php _e('Know More','framework'); ?></a>
                        <?php
                    }
                    ?>
                </p>
            </div>

            <?php
            if(!empty($agent_email)){
                ?>
                <div class="contact-form">

                    <h3><?php _e('Contact', 'framework'); ?></h3>

                    <form id="agent-contact-form" class="contact-form-small" method="post" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">

                        <input type="text" name="name" id="name" placeholder="<?php _e('Name', 'framework'); ?>" class="required" title="<?php _e('* Please provide your name', 'framework'); ?>">

                        <input type="text" name="email" id="email" placeholder="<?php _e('Email', 'framework'); ?>" class="email required" title="<?php _e('* Please provide valid email address', 'framework'); ?>">

                        <textarea  name="message" id="comment" class="required" placeholder="<?php _e('Message', 'framework'); ?>" title="<?php _e('* Please provide your message', 'framework'); ?>"></textarea>

                        <?php
                        /* Display recaptcha if enabled and configured from theme options */
                        get_template_part('recaptcha/custom-recaptcha');
                        ?>

                        <input type="hidden" name="target" value="<?php echo antispambot($agent_email); ?>">
                        <input type="hidden" name="action" value="send_message_to_agent" />
                        <input type="hidden" name="property_title" value="<?php echo $property_title; ?>" />
                        <input type="hidden" name="property_permalink" value="<?php echo $property_permalink; ?>" />

                        <input type="submit" value="<?php _e('Send Message','framework'); ?>"  name="submit" class="real-btn">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="contact-loader" alt="Loading...">

                    </form>

                    <div class="error-container"></div>
                    <div id="message-sent">&nbsp;</div>
                </div>
                <?php
            }
            ?>

        </div>
        <?php

    }
}
?>