<?php

namespace Cookie_Legit\Admin;

class Cookie_Legit_Admin_Assets
{

    /**
     * Load the stylesheets for the admin
     * @return void 
     */
    public static function load_styles($hook)
    {
        if($hook !== 'toplevel_page_cookie-legit') {
            return;
        }

        wp_enqueue_style('cl-admin-main', COOKIE_LEGIT_URL . 'dist/admin.css', [], COOKIE_LEGIT_VERSION);
    }

    /**
     * Load the scripts for the admin
     * @return void 
     */
    public static function load_scripts($hook)
    {
        if($hook !== 'toplevel_page_cookie-legit') {
            return;
        }

        wp_enqueue_script('cl-admin-main', COOKIE_LEGIT_URL . 'dist/admin.js', ['jquery'], COOKIE_LEGIT_VERSION, true);
    }

}
