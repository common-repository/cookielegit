<?php 

namespace Cookie_Legit\Admin;

use Cookie_Legit\Models\Cookie_Legit_Settings;
use Error;

class Cookie_Legit_Admin_Requests 
{

    /**
     * Save the settings
     * @return void 
     * @throws Error 
     */
    public static function save_settings()
    {
        if(isset($_POST['_cl_save_settings_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_cl_save_settings_nonce'])), 'cl_save_settings')) {
            $settingsKey = sanitize_key($_POST['settings_key']) . "_settings";
            $optionKey = sanitize_key($_POST['option_name']);
            
            /**
             * Sanitize and validate the settings recursively 
             * @see Cookie_Legit_Settings
             */
            $sanitizedSettings = Cookie_Legit_Settings::sanitizeMany($_POST[$settingsKey]);
            update_option($optionKey, $sanitizedSettings);
        }
        
        wp_redirect(isset($_POST['_wp_http_referer']) ? sanitize_url($_POST['_wp_http_referer']) : sanitize_url(admin_url('admin.php')) . '?page=' . COOKIE_LEGIT_SLUG);
    }
}