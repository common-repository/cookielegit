<?php

namespace Cookie_Legit;

class Cookie_Legit_Translations
{
    /**
     * Load the translations provider
     * @return void 
     */
    public static function load()
    {
        add_action('init', array(self::class, 'load_text_domain'));
    }

    /**
     * Load the plugin text domain
     * @return void
     */
    public static function load_text_domain()
    {
        load_plugin_textdomain('cookie-legit', false,  'cookie-legit/languages');
    }
}