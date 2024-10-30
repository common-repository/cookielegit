<?php

namespace Cookie_Legit\Models;

class Cookie_Legit_Settings
{

  /**
   * The setting group to register under
   * @var string
   */
  public static $settingGroup = "cookie-legit-options-group";

  /**
   * The prefix for the settings
   * @var string
   */
  public static $settingPrefix = 'cookie_legit_';

  /**
   * The default settings
   * @var array
   */
  private static function default_settings()
  {
    return array(
      'notice' => array(
        'banner' => array(
          'type' => 'banner',
          'position' => 'bottom',
          'text' => esc_html__("This website uses cookies to ensure the best user experience.", 'cookie-legit'),
          'style' => array(
            'background_color' => "#FFFFFF",
            'color' => "#000000",
            'border_radius' => "0"
          ),
        ),
        'privacy_link' => array(
          'text' => esc_html__('Learn more', 'cookie-legit'),
          'link' => '/privacy',
          'style' => array(
            'color' => "#28A745"
          ),
        ),
        'buttons' => array(
          'preference' => array(
            'text' => esc_html__('Change preferences', 'cookie-legit'),
            'style' => array(
              'background_color' => "#FFFFFF",
              'color' => "#000000",
              'border_radius' => 5
            ),
          ),
          'save_preference' => array(
            'text' => esc_html__('Save preferences', 'cookie-legit'),
            'style' => array(
              'background_color' => "#ffffff",
              'color' => "#000000",
              'border_radius' => 5
            ),
          ),
          'accept' => array(
            'text' => esc_html__('Accept', 'cookie-legit'),
            'style' => array(
              'background_color' => "#28A745",
              'color' => "#FFFFFF",
              'border_radius' => 5
            ),
          ),
          'deny' => array(
            'text' => esc_html__('Deny', 'cookie-legit'),
            'style' => array(
              'background_color' => "#FFFFFF",
              'color' => "#000000",
              'border_radius' => 5
            ),
          ),
        ),
        'texts' => array(
          'essential' => array(
            'title' => esc_html__("Essential cookies", 'cookie-legit'),
            "description" => esc_html__("Cookies that make the website function as intended", 'cookie-legit')
          ),
          'tracking' => array(
            'title' => esc_html__("Analytical cookies", 'cookie-legit'),
            'description' => esc_html__("Cookies that keep track of you.", 'cookie-legit'),
          ),
          'marketing' => array(
            'title' => esc_html__("Marketing cookies", 'cookie-legit'),
            'description' => esc_html__("Cookies with marketing purpose.", 'cookie-legit'),
          )
        ),
        'user_opt' => 'on',
      ),
      'pixels' => array(
        'codes' => array(
          'google_tag_manager' => '',
          'google_analytics' => '',
          'linkedin_pixel' => '',
          'meta_pixel' => '',
        ),
        'consent_mode' => false
      ),
      'blocking' => array(
        'iframes' => array(
          'block' => false,
          'overlay' => array(
            'text' => esc_html__('Allow marketing cookies to see iframes', 'cookie-legit'),
            'style' => array(
              'background_color' => '#000000',
              'color' => '#FFFFFF'
            )
          )
        ),
        'scripts' => array(
          'block' => false,
          'excludes' => "jquery.min.js\njquery-migrate.min.js\n"
        )
      ),
      'additional' => array(
        'give_some_love' => false,
      )
    );
  }

  /**
   * Possible notice types
   * @var string[]
   */
  public static function notices_types()
  {
    return [
      [
        'type' => 'banner',
        'positions' => [
          'top' => esc_html__('Top', 'cookie-legit'),
          'bottom' => esc_html__('Bottom', 'cookie-legit')
        ]
      ],
      [
        'type' => 'card',
        'positions' => [
          'top-left' => esc_html__('Top left', 'cookie-legit'),
          'top-right' => esc_html__('Top right', 'cookie-legit'),
          'bottom-left' => esc_html__('Bottom left', 'cookie-legit'),
          'bottom-right' => esc_html__('Bottom right', 'cookie-legit')
        ]
      ],
      [
        'type' => 'wall',
        'positions' => []
      ]
    ];
  }

  /**
   * Default settings type for sanitization
   * @var ((string|string[])[]|(string|string[])[][]|string|string[])[]
   */
  private static $defaultSettingTypes = array(
    'banner' => array(
      'type' => 'text',
      'position' => 'text',
      'text' => "text",
      'style' => array(
        'background_color' => "color",
        'color' => "color",
        'border_radius' => "text"
      ),
    ),
    'privacy_link' => array(
      'text' => 'text',
      'link' => 'url',
      'style' => array(
        'color' => "color"
      ),
    ),
    'buttons' => array(
      'preference' => array(
        'text' => 'text',
        'style' => array(
          'background_color' => "color",
          'color' => "color",
          'border_radius' => "text"
        ),
      ),
      'save_preference' => array(
        'text' => 'Save preferences',
        'style' => array(
          'background_color' => "color",
          'text_color' => "color",
          'border_radius' => "text"
        ),
      ),
      'accept' => array(
        'text' => 'text',
        'style' => array(
          'background_color' => "color",
          'color' => "text",
          'border_radius' => "text"
        ),
      ),
      'deny' => array(
        'text' => 'text',
        'style' => array(
          'background_color' => "color",
          'color' => "color",
          'border_radius' => "text"
        ),
      ),
    ),
    'texts' => array(
      'essential' => array(
        'title' => "text",
        "description" => "textarea"
      ),
      'tracking' => array(
        'title' => "text",
        'description' => "textarea",
      ),
      'marketing' => array(
        'title' => "text",
        'description' => "textarea",
      )
    ),
    'user_opt' => 'text',
    'consent_mode' => 'text',
    'codes' => array(
      'google_tag_manager' => 'text',
      'google_analytics' => 'text',
      'linkedin_pixel' => 'text',
      'meta_pixel' => 'text',
    ),
    'iframes' => array(
      'block' => 'text',
      'overlay' => array(
        'text' => 'textarea',
        'style' => array(
          'background_color' => 'color',
          'color' => 'color'
        )
      )
    ),
    'scripts' => array(
      'block' => 'text',
      'excludes' => "textarea"
    ),
    'give_some_love' => 'text'
  );

  /**
   * Get the filtered default settings
   * @return mixed 
   */
  public static function get_default_settings()
  {
    return apply_filters('cookie_legit_default_settings', self::default_settings());
  }

  /**
   * Get the filtered setting types
   * @return mixed 
   */
  public static function get_setting_types()
  {
    return apply_filters('cookie_legit_setting_types', self::$defaultSettingTypes);
  }

  /**
   * Sanitize the settings based on type
   * @param mixed $value 
   * @param string $type 
   * @return string|void 
   */
  private static function sanitize($value, $type = 'text')
  {
    switch ($type) {
      case 'text':
        $value = sanitize_text_field($value);
        break;
      case 'textarea':
        $value = sanitize_textarea_field($value);
        break;
      case 'url':
        $value = sanitize_url($value);
        break;
      case 'color':
        $value = sanitize_hex_color($value);
        break;
      default:
        $value = sanitize_text_field($value);
    }

    return $value;
  }

  /**
   * Recursive sanitization for settings 
   * @param mixed $settings 
   * @param array $types 
   * @return string|void|array 
   */
  public static function sanitizeMany($settings, $types = [])
  {
    $sanitizedSettings = [];
    $type = empty($types) ? self::get_setting_types() : $types;

    if (gettype($settings) !== 'array') {
      return self::sanitize($settings, $type);
    } else {
      foreach ($settings as $key => $value) {
        $sanitizedSettings[$key] = self::sanitizeMany($value, $type[$key]);
      }
    }
    return $sanitizedSettings;
  }

  /**
   * Get the option name for notice settings
   * @return string 
   */
  public static function get_notice_settings_name()
  {
    return 'cookie_legit_notice' . self::get_translation_addition();
  }

  /**
   * Get the filtered notice settings
   * @param bool $include_default 
   * @return mixed 
   */
  public static function get_notice_settings($include_default = true)
  {
    $default_value = $include_default ? self::get_default_settings()['notice'] : [];
    return apply_filters('cookie_legit_notice_settings', get_option(self::get_notice_settings_name(), $default_value), $include_default);
  }

  /**
   * Get the option name for pixel settings
   * @return string 
   */
  public static function get_pixel_settings_name()
  {
    return 'cookie_legit_pixels';
  }

  /**
   * Get the pixel settings
   * @param bool $include_default 
   * @return mixed 
   */
  public static function get_pixel_settings($include_default = true)
  {
    $default_value = $include_default ? self::get_default_settings()['pixels'] : [];
    return apply_filters('cookie_legit_pixel_settings', get_option(self::get_pixel_settings_name(), $default_value), $include_default);
  }

  /**
   * Get the option name for blocking settings
   * @return string 
   */
  public static function get_blocking_settings_name()
  {
    return 'cookie_legit_blocking' . self::get_translation_addition();
  }

  /**
   * Get the blocking settings
   * @param bool $include_default 
   * @return mixed 
   */
  public static function get_blocking_settings($include_default = true)
  {
    $default_value = $include_default ? self::get_default_settings()['blocking'] : [];
    return apply_filters('cookie_legit_blocking_settings', get_option(self::get_blocking_settings_name(), $default_value), $include_default);
  }

  /**
   * Get the option name for additional settings
   * @return string 
   */
  public static function get_additional_settings_name()
  {
    return 'cookie_legit_additional';
  }

  /**
   * Get the additional settings
   * @param bool $include_default 
   * @return mixed 
   */
  public static function get_additional_settings($include_default = true)
  {
    $default_value = $include_default ? self::get_default_settings()['additional'] : [];
    return apply_filters('cookie_legit_additional_settings', get_option(self::get_additional_settings_name(), $default_value), $include_default);
  }

  /**
   * Get the translation addition
   * @return string 
   */
  private static function get_translation_addition()
  {

    if (cookie_legit_is_translatable()) {
      return "_" . cookie_legit_current_language();
    }

    return '';
  }

  /**
   * Get the translated notice type
   * @param string $notice_type
   * @return string The translated notice type
   */
  public static function get_translated_notice_type($notice_type)
  {
    return match ($notice_type) {
      'wall' => esc_html__('Wall', 'cookie-legit'),
      'banner' => esc_html__('Banner', 'cookie-legit'),
      'card' => esc_html__('Card', 'cookie-legit'),
    };
  }
}
