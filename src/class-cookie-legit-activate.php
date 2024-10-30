<?php

namespace Cookie_Legit;

use Cookie_Legit\Models\Cookie_Legit_Settings;

class Cookie_Legit_Activate {

  /**
   * The function to run on activation
   * @return void 
   */
  public static function activate()
  {
    self::register_settings();
  }

  /**
   * Register the necessary settings
   * @return void 
   */
  private static function register_settings()
  {
    foreach(Cookie_Legit_Settings::get_default_settings() as $setting_name => $settings) {
      update_option(Cookie_Legit_Settings::$settingPrefix . $setting_name, $settings);
    }
  }
}
