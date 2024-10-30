<?php

/**
 * Check if a translation plugin is installed
 * @return bool 
 */
function cookie_legit_is_translatable()
{
    return (
        function_exists('weglot_get_current_language') ||
        function_exists('icl_get_current_language') ||
        has_filter('wpml_current_language')
    );
}

/**
 * Get the current language or null for no translation plugin
 * @return mixed 
 */
function cookie_legit_current_language()
{
    if(function_exists('weglot_get_current_language') && !empty(weglot_get_current_language())) {
        return esc_html(weglot_get_current_language());
    }

    if(function_exists('icl_get_current_language') && icl_get_current_language()) {
        return esc_html(icl_get_current_language());
    }

    if(has_filter('wpml_current_language')) {
        return apply_filters('wpml_current_language', null);
    }
    
    return null;
}