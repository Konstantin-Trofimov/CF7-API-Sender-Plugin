<?php 
/**
 * Plugin name: CF7 API Sender
 * Plugin URI: https://github.com/Konstantin-Trofimov
 * Description: Submit Contact Form 7 Field Data to External API
 * Author: Konstantin Trofimov
 * Author URI: https://github.com/Konstantin-Trofimov
 * version: 0.1.0
 * License: GPL2 or later.
 * text-domain: query-apis
 */
 
add_action('wpcf7_mail_sent', 'cf7_api_sender');
    
function cf7_api_sender( $contact_form ) {
    $title = $contact_form->title; 

    // FORM TITLE 

    // if ( $title === 'PASTE FORM TITLE HERE' ) {
    if ( $title === 'Get quote Buy step 4' || $title === 'Get quote Modifications 4' || $title === 'Get quote relocations 4' || $title === 'Order Online Buy step 5' || $title === 'Order online modifications step 5' || $title === 'Order online Relocations 6') {
        $submission = WPCF7_Submission::get_instance();
            
        if ( $submission ) {
            $posted_data = $submission->get_posted_data();
            
            // STEP 1
            
            $service_type = $posted_data['service-type'];
 
            // STEP 2  Relocations
            
            $pickup_location  = $posted_data['pickup-location'];
            $delivery_address = $posted_data['delivery-address'];
            $text_weight      = $posted_data['text-weight'];
            
            // STEP 2 (or 3 for relocations service type)
            
            $container_type    = $posted_data['container-type'];
            $text_comment      = $posted_data['text-comment'];
            
            // STEP 2 20FT
            
            $container_20_new    = $posted_data['container20new'];
            $container_20_used   = $posted_data['container20used'];
            $container_20_custom = $posted_data['container20custom'];
            
            // STEP 2 40FT
            
            $container_40_new    = $posted_data['container40new'];
            $container_40_used   = $posted_data['container40used'];
            $container_40_custom = $posted_data['container40custom'];
            
            // STEP 2 Special
            
            $container_special_new    = $posted_data['containerSpecialNew'];
            $container_special_used   = $posted_data['containerSpecialUsed'];
            $container_special_custom = $posted_data['containerSpecialCustom'];
            
           
            // STEP 3
           
            $delivery_need = $posted_data['delivery_need'];
           
            $delivery_province = $posted_data['delivery-province'];
            $delivery_city     = $posted_data['delivery-city'];
            $delivery_street   = $posted_data['delivery-street'];
            $delivery_zip      = $posted_data['delivery-zip'];
            
            // STEP 4
            
            $name    = $posted_data['your-name'];
            $email   = $posted_data['your-email'];
            $phone   = $posted_data['your-phone'];
            $city    = $posted_data['your-city'];
            $message = $posted_data['your-message'];
            $consent = $posted_data['your-consent'];
            $how_pay = $posted_data['how-pay'];

            $modification_description = $posted_data['modification-description'];

            $should_load = $posted_data['should_load'];
            $use_address = $posted_data['use-address'];

            $billing_name = $posted_data['billing-name'];
            $billing_email = $posted_data['billing-email'];
            $billing_phone = $posted_data['billing-phone'];
            $billing_address = $posted_data['billing-address'];

            // Relocations 

            $contact_name     = $posted_data['contact-name'];
            $contact_phone    = $posted_data['contact-phone'];
            $contact_address  = $posted_data['contact-address'];
            $delivery_name    = $posted_data['delivery-name'];
            $delivery_phone   = $posted_data['delivery-phone'];
           
            // URL

            $url = 'PASTE URL HERE';

            $body = [
                'service-type'   => $service_type,
                
                'pickup-location'    => $pickup_location,
                'delivery-address'   => $delivery_address,
                'approximate-weight' => $text_weight,
                
                'container-type' => $container_type,
                
                'container-20-new'    => $container_20_new,
                'container-20-used'   => $container_20_used,
                'container-20-custom' => $container_20_custom,
                
                'container-40-new'    => $container_40_new,
                'container-40-used'   => $container_40_used,
                'container-40-custom' => $container_40_custom,
                
                'container-specia-new'    => $container_special_new,
                'container-specia-used'   => $container_special_used,
                'container-specia-custom' => $container_special_custom,
                
                'text-comment' => $text_comment,
                
                'delivery-need'       => $delivery_need,
                'delivery-province'   => $delivery_province,
                'delivery-city'       => $delivery_city,
                'delivery-street'     => $delivery_street,
                'delivery-zip'        => $delivery_zip,

                'contact-name'       => $contact_name,
                'contact-phone'      => $contact_phone,
                'contact-address'    => $contact_address,
                'delivery-name'      => $delivery_name,
                'delivery-phone'     => $delivery_phone,
                
                'customer-name'    => $name,
                'customer-email'   => $email,
                'customer-phone'   => $phone,
                'customer-city'    => $city,
                'customer-message' => $message,
                'customer-consent' => $consent,
                'how-pay' => $how_pay,

                'modification-description' => $modification_description,

                'should-load' => $should_load,
                'use-address' => $use_address,

                'billing-name'    => $billing_name,
                'billing-email'   => $billing_email,
                'billing-phone'   => $billing_phone,
                'billing-address' => $billing_address,
            ];

            $body = wp_json_encode( $body );

            $options = [
                'body'        => $body,
                'headers'     => [
                    'Content-Type' => 'application/json',
                ],
            ];
            
            wp_remote_post( $url, $options );
        }
    }
}
?>