<?php

namespace Cookie_Legit\Admin;

use Cookie_Legit\Cookie_Legit_View_Loader;
use Cookie_Legit\Models\Cookie_Legit_Settings;

class Cookie_Legit_Admin_Pages
{
    /**
     * Load the plugin settings
     * @return void 
     */
    public static function settings()
    {
        $active_screen = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : false;
        $notice_settings = Cookie_Legit_Settings::get_notice_settings();
        $pixel_settings = Cookie_Legit_Settings::get_pixel_settings();
        $blocking_settings = Cookie_Legit_Settings::get_blocking_settings();
        $additional_settings = Cookie_Legit_Settings::get_additional_settings();

        $consent_mode = (isset($pixel_settings['consent_mode']) && $pixel_settings['consent_mode'] === 'on');

        Cookie_Legit_View_Loader::load('admin.settings.settings', [
            'notice_settings' => $notice_settings,
            'pixel_settings' => $pixel_settings,
            'consent_mode' => $consent_mode,
            'blocking_settings' => $blocking_settings,
            'active_screen' => $active_screen,
            'notice_types' => Cookie_Legit_Settings::notices_types(),
            'notice_settings_key' => Cookie_Legit_Settings::get_notice_settings_name(),
            'pixel_settings_key' => Cookie_Legit_Settings::get_pixel_settings_name(),
            'blocking_settings_key' => Cookie_Legit_Settings::get_blocking_settings_name(),
            'additional_settings' => $additional_settings,
            'additional_settings_key' => Cookie_Legit_Settings::get_additional_settings_name(),
        ]);
    }
}