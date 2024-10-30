<?php

namespace Cookie_Legit\Admin;

class Cookie_Legit_Admin_Loader
{
    /**
     * Load all the actions and filters for the WP Admin
     * @return void 
     */
    public static function load()
    {
        add_action('admin_menu', array(Cookie_Legit_Admin_Menu::class, 'register_main_menu'));
        add_action('admin_menu', array(Cookie_Legit_Admin_Menu::class, 'register_sub_menus'));

        add_action('admin_enqueue_scripts', array(Cookie_Legit_Admin_Assets::class, 'load_styles'));
        add_action('admin_enqueue_scripts', array(Cookie_Legit_Admin_Assets::class, 'load_scripts'));

        add_action('admin_post_cl_save_settings', array(Cookie_Legit_Admin_Requests::class, 'save_settings'));
    }
}
