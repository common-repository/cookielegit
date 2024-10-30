<?php

/**
 * @package CookieLegit
 * Plugin Name: CookieLegit
 * Description: The last cookie manager you'll need
 * Version: 1.0.2
 * Author: CookieLegit
 * Author URI: https://cookielegit.site/
 * Contributors: ducodr
 * Text Domain: cookie-legit
 * Domain Path: /languages
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 5.8
 * Tested up to: 6.6.1
 * Requires PHP: 8.0
 */

// Abort if file is called directly
if (!defined('ABSPATH')) {
  die('Direct file access is not allowed');
}

if (!defined('COOKIE_LEGIT_VERSION')) {
  define('COOKIE_LEGIT_VERSION', '1.0.0');
}

if (!defined('COOKIE_LEGIT_PATH')) {
  define('COOKIE_LEGIT_PATH', plugin_dir_path(__FILE__));
}

if (!defined('COOKIE_LEGIT_URL')) {
  define('COOKIE_LEGIT_URL', plugin_dir_url(__FILE__));
}

if (!defined('COOKIE_LEGIT_SLUG')) {
  define('COOKIE_LEGIT_SLUG', 'cookie-legit');
}

if (!defined('COOKIE_LEGIT_SITE_URL')) {
  define('COOKIE_LEGIT_SITE_URL', 'https://cookielegit.site');
}

require_once(COOKIE_LEGIT_PATH . 'src/class-cookie-legit-autoloader.php');
Cookie_Legit_Autoloader::register();

require_once(COOKIE_LEGIT_PATH . 'cookie-legit-functions.php');

register_activation_hook(__FILE__, array(Cookie_Legit\Cookie_Legit_Activate::class, 'activate'));

$cookie_legit = Cookie_Legit\Cookie_Legit_Main::boot(
  COOKIE_LEGIT_VERSION,
  COOKIE_LEGIT_PATH,
  COOKIE_LEGIT_URL
);
