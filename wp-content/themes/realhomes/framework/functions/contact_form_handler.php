<?php
/**
 * File Name: contact_form_handler.php
 *
 * Send message function to process contact form submission
 *
 */

add_action( 'wp_ajax_nopriv_send_message', 'send_message' );
add_action( 'wp_ajax_send_message', 'send_message' );

if( !function_exists( 'send_message' ) ){
    function send_message()
    {
        if(isset($_POST['email'])):

            $show_reCAPTCHA = get_option('theme_show_reCAPTCHA');
            $reCAPTCHA_public_key = get_option('theme_recaptcha_public_key');
            $reCAPTCHA_private_key = get_option('theme_recaptcha_private_key');

            if(!empty($reCAPTCHA_public_key) && !empty($reCAPTCHA_private_key) && $show_reCAPTCHA == 'true' ){
                /* Include recaptcha library */
                require_once( get_template_directory().'/recaptcha/recaptchalib.php' );
                $resp = recaptcha_check_answer ($reCAPTCHA_private_key,
                                                $_SERVER["REMOTE_ADDR"],
                                                $_POST["recaptcha_challenge_field"],
                                                $_POST["recaptcha_response_field"]);

                if (!$resp->is_valid){
                    /* What happens when the CAPTCHA was entered incorrectly */
                    die (__("The reCAPTCHA was not entered correctly. Please try it again.","framework"));
                }
            }


            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $address = $_POST['target'];

            if(get_magic_quotes_gpc()) {
                $message = stripslashes($message);
            }

            $e_subject = __('You Have Received a Message From ','framework') . $name . '.';

            if(!empty($subject)){
                $e_subject = $subject . ':' . $name . '.';
            }

            $e_body = 	__("You have Received a message from: ", 'framework')
                .$name
                . "\n"
                .__("Their additional message is as follows.", 'framework')
                ."\r\n\n";

            $e_content = "\" $message \"\r\n\n";

            $e_reply = 	__("You can contact", 'framework')." ".$name." ".__("via email,", 'framework')." ".$email;

            $msg = $e_body . $e_content . $e_reply;

            if(wp_mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n","-f $address")){
                echo '<div class="success-message">';
                _e("Message Sent Successfully!", 'framework');
                echo '</div>';
            }
            else{
                _e("Server Error: WordPress mail method failed!", 'framework');
            }

        else:
            _e("Invalid Request !", 'framework');
        endif;

        die;

    }
}

add_action( 'wp_ajax_nopriv_send_message_to_agent', 'send_message_to_agent' );
add_action( 'wp_ajax_send_message_to_agent', 'send_message_to_agent' );

if( !function_exists( 'send_message_to_agent' ) ){
    function send_message_to_agent(){
        if(isset($_POST['email'])):

            $show_reCAPTCHA = get_option('theme_show_reCAPTCHA');
            $reCAPTCHA_public_key = get_option('theme_recaptcha_public_key');
            $reCAPTCHA_private_key = get_option('theme_recaptcha_private_key');

            if(!empty($reCAPTCHA_public_key) && !empty($reCAPTCHA_private_key) && $show_reCAPTCHA == 'true' ){
                /* Include recaptcha library */
                require_once( get_template_directory().'/recaptcha/recaptchalib.php' );
                $resp = recaptcha_check_answer ($reCAPTCHA_private_key,
                                                $_SERVER["REMOTE_ADDR"],
                                                $_POST["recaptcha_challenge_field"],
                                                $_POST["recaptcha_response_field"]);

                if (!$resp->is_valid){
                    /* What happens when the CAPTCHA was entered incorrectly */
                    die (__("The reCAPTCHA was not entered correctly. Please try it again.","framework"));
                }
            }


            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $address = $_POST['target'];
            $property_title = $_POST['property_title'];
            $property_permalink = $_POST['property_permalink'];

            if(get_magic_quotes_gpc()) {
                $message = stripslashes($message);
            }

            $e_subject = __('You Have Received a Message From ','framework') . $name . '.';

            $e_body = 	__("You have Received a message from: ", 'framework')
                .$name
                ."\r\n\n"
                .__("Message is sent using agent contact form on following property:", 'framework')
                . $property_title
                . "\n"
                .__("You can view the property using following URL:", 'framework')
                .$property_permalink
                ."\r\n\n"
                .__("Their additional message is as follows.", 'framework')
                ."\r\n\n";

            $e_content = "\" $message \"\r\n\n";

            $e_reply = 	__("You can contact", 'framework')." ".$name." ".__("via email,", 'framework')." ".$email;

            $msg = $e_body . $e_content . $e_reply;

            $headers = array();
            $headers[] = "From: $email";

            /* Send copy of message to admin if configured */
            $theme_send_message_copy = get_option('theme_send_message_copy');
            if( $theme_send_message_copy == 'true' ){
                $theme_message_copy_email = get_option('theme_message_copy_email');
                if( !empty( $theme_message_copy_email ) ){
                    $headers[] = "Cc: $theme_message_copy_email";
                }
            }

            if(wp_mail($address, $e_subject, $msg, $headers)){
                echo '<div class="success-message">';
                _e("Message Sent Successfully!", 'framework');
                echo '</div>';
            }else{
                _e("Server Error: WordPress mail method failed!", 'framework');
            }

        else:
            _e("Invalid Request !", 'framework');
        endif;
        die;
    }
}

?>