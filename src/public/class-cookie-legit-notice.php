<?php

namespace Cookie_Legit\Public;

use Cookie_Legit\Cookie_Legit_View_Loader;
use Cookie_Legit\Models\Cookie_Legit_Settings;

class Cookie_Legit_Notice
{
    /**
     * Enqueue the scripts and styles for the notice
     * @return void 
     */
    public static function enqueue_assets()
    {
        // wp_enqueue_style('cl-main', COOKIE_LEGIT_URL . 'dist/public.css', [], COOKIE_LEGIT_VERSION);
        wp_enqueue_script('cl-main', COOKIE_LEGIT_URL . 'dist/public.js', ['jquery'], COOKIE_LEGIT_VERSION, true);

        $notice_settings = Cookie_Legit_Settings::get_notice_settings(false);
        $pixel_settings = Cookie_Legit_Settings::get_pixel_settings(false);

        wp_localize_script('cl-main', 'cl_config', array(
            'consent_mode' => (isset($pixel_settings['consent_mode']) && $pixel_settings['consent_mode'] === 'on'),
            'user_opt' => (isset($notice_settings['user_opt']) && $notice_settings['user_opt'] === 'on'),
            'ajax_url' => admin_url('admin-ajax.php'),
            'themeUrl' => COOKIE_LEGIT_URL . 'dist/public.css'
        ));
    }

    /**
     * Get the HTML for the cookie notice
     * @return void 
     */
    public static function get_cookie_notice()
    {
        $notice_settings = Cookie_Legit_Settings::get_notice_settings(false);

        if(empty($notice_settings)) { return; }

        $additional_settings = Cookie_Legit_Settings::get_additional_settings(false);
        $give_love = (isset($additional_settings['give_some_love']) &&  $additional_settings['give_some_love'] === 'on');

        $notice = Cookie_Legit_View_Loader::load('public.notice', array(
            'banner' => $notice_settings['banner'],
            'user_opt' => (isset($notice_settings['user_opt']) && $notice_settings['user_opt'] === 'on'),
            'privacy_link' => $notice_settings['privacy_link'],
            'preference_button' => $notice_settings['buttons']['preference'],
            'save_preference_button' => $notice_settings['buttons']['save_preference'],
            'accept_button' => $notice_settings['buttons']['accept'],
            'deny_button' => $notice_settings['buttons']['deny'],
            'cookie_type_texts' => $notice_settings['texts'],
            'give_some_love' => $give_love,
        ), false);

        wp_send_json(array(
            'html' => $notice
        ));
    }
}
