<?php

namespace Cookie_Legit\Public;

class Cookie_Legit_Action_Loader
{
    /**
     * Load the admin provider
     * @return void 
     */
    public static function load()
    {
        add_action('wp_enqueue_scripts', array(Cookie_Legit_Notice::class, 'enqueue_assets'));

        add_action('wp_ajax_get_cookie_notice', array(Cookie_Legit_Notice::class, 'get_cookie_notice'));
        add_action('wp_ajax_nopriv_get_cookie_notice', array(Cookie_Legit_Notice::class, 'get_cookie_notice'));

        add_action('wp_ajax_get_tracking_scripts', array(Cookie_Legit_Pixel_Loader::class, 'get_tracking_scripts'));
        add_action('wp_ajax_nopriv_get_tracking_scripts', array(Cookie_Legit_Pixel_Loader::class, 'get_tracking_scripts'));

        add_action('wp_head', array(Cookie_Legit_Pixel_Loader::class, 'maybe_load_gtm_consent_header_pixels'));
        add_action('wp_footer', array(Cookie_Legit_Pixel_Loader::class, 'maybe_load_gtm_consent_footer_pixels'));

        add_action('script_loader_tag', array(Cookie_Legit_Blocker::class, 'maybe_block_scripts'), 10, 3);
        add_action('the_content', array(Cookie_Legit_Blocker::class, 'maybe_block_iframes'), 10, 3);
    }
}
