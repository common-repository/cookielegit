<?php

namespace Cookie_Legit\Admin;

class Cookie_Legit_Admin_Menu
{
    /**
     * Register the main menu item
     * @return void
     */
    public static function register_main_menu()
    {
        add_menu_page(
            esc_html__('Cookie Legit', 'cookie-legit'),
            esc_html__('Cookie Legit', 'cookie-legit'),
            'manage_options',
            COOKIE_LEGIT_SLUG,
            array(Cookie_Legit_Admin_Pages::class, 'settings'),
            '',
            81
        );
    }

    /**
     * Register the submenu items
     * @return void 
     */
    public static function register_sub_menus()
    {
        add_submenu_page(
            COOKIE_LEGIT_SLUG, 
            esc_html__('Notice settings', 'cookie-legit'),
            esc_html__('Notice settings', 'cookie-legit'),
            'manage_options',
            COOKIE_LEGIT_SLUG . '&s=notice',
            array(Cookie_Legit_Admin_Pages::class, 'settings')
        );

        add_submenu_page(
            COOKIE_LEGIT_SLUG, 
            esc_html__('Pixel settings', 'cookie-legit'),
            esc_html__('Pixel settings', 'cookie-legit'),
            'manage_options',
            COOKIE_LEGIT_SLUG . '&s=pixel',
            array(Cookie_Legit_Admin_Pages::class, 'settings')
        );

        add_submenu_page(
            COOKIE_LEGIT_SLUG, 
            esc_html__('Blocking', 'cookie-legit'),
            esc_html__('Blocking', 'cookie-legit'),
            'manage_options',
            COOKIE_LEGIT_SLUG . '&s=blocking',
            array(Cookie_Legit_Admin_Pages::class, 'settings')
        );
    }
}