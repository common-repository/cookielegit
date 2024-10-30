<?php

namespace Cookie_Legit\Public;

use Cookie_Legit\Cookie_Legit_View_Loader;
use Cookie_Legit\Models\Cookie_Legit_Settings;

class Cookie_Legit_Pixel_Loader
{
    /**
     * Load the GTM header script
     * @return void 
     */
    public static function maybe_load_gtm_consent_header_pixels()
    {
        self::load_gmt_consent_scripts('head');
    }

    /**
     * Load the GTM footer script
     * @return void 
     */
    public static function maybe_load_gtm_consent_footer_pixels()
    {
        self::load_gmt_consent_scripts('footer');
    }

    /**
     * Load the GTM script for either the footer or header
     * @param mixed $placement 
     * @return void 
     */
    private static function load_gmt_consent_scripts($placement)
    {
        $pixel_settings = apply_filters('cookie_legit_pixels', Cookie_Legit_Settings::get_pixel_settings(false));
        $consent_mode = (isset($pixel_settings['consent_mode']) && $pixel_settings['consent_mode'] === 'on');

        if ($consent_mode) {
            wp_enqueue_script('cookie-legit-tagmanager', COOKIE_LEGIT_URL . 'pixels/google/cookie-legit-tagmanager.js', [], COOKIE_LEGIT_VERSION);
            wp_localize_script('cookie-legit-tagmanager', 'tracking_codes', array(
            "google" => $pixel_settings["codes"]["google_tag_manager"],
            ));
        }
    }

    /**
     * Get the available tracking pixels
     * @return void 
     */
    public static function get_tracking_scripts()
    {
        $pixel_settings = apply_filters('cookie_legit_pixels', Cookie_Legit_Settings::get_pixel_settings(false));
        $scripts = [];

        $placements = ['head', 'body'];

        foreach ($placements as $placement) {
            $scripts[$placement] = [];
            foreach ($pixel_settings['codes'] as $pixel_name => $pixel_value) {
                $view = "public.pixels.{$placement}.{$pixel_name}";
                if (Cookie_Legit_View_Loader::exists($view) && $pixel_value !== '') {
                    $scripts[$placement][$pixel_name] = Cookie_Legit_View_Loader::load($view, [
                        'tracking_code' => $pixel_value
                    ], false);
                }
            }
        }

        wp_send_json($scripts);
    }
}
