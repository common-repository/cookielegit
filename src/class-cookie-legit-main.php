<?php 

namespace Cookie_Legit;

use Cookie_Legit\Admin\Cookie_Legit_Admin_Loader;
use Cookie_Legit\Public\Cookie_Legit_Action_Loader;

class Cookie_Legit_Main {
  
  /**
   * @var Cookie_Legit_Main the instance of the plugin
   */
  private static $_instance;
  
  /**
   * @var array $providers The action and filter providers for the plugin
   */
  private static $providers = [
    Cookie_Legit_Admin_Loader::class,
    Cookie_Legit_Action_Loader::class,
    Cookie_Legit_Translations::class
  ];

  /**
   * Prevent new initialization
   * @return void 
   */
  private function __construct()
  {
  }

  /**
   * Boot the plugin
   * @return Cookie_Legit_Main|Cookie_Legit\Cookie_Legit_Main 
   */
  public static function boot($version, $baseDir, $baseUrl)
  {
    $cl_plugin = self::get_instance(); 

    foreach ($cl_plugin::$providers as $provider) {
      $provider::load();
    }

    return $cl_plugin;
  }

  /**
   * Get the instance of the plugin
   * @return Cookie_Legit_Main|Cookie_Legit\Cookie_Legit_Main
   */
  public static function get_instance()
  {
    if(self::$_instance === null) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

}