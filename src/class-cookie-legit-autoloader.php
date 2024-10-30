<?php 

class Cookie_Legit_Autoloader {
  /**
   * The default namespace
   * @var string
   */
  private static $defaultNameSpace = "Cookie_Legit\\";

  /**
   * The src path
   * @var string
   */
  private static $defaultDir = COOKIE_LEGIT_PATH . 'src/';

  /**
   * Register the autoloader
   * @return bool 
   * @throws TypeError 
   */
  public static function register()
  {
    return spl_autoload_register(array(__CLASS__, 'load'));
  }

  /**
   * Load the class
   * @param mixed $class 
   * @return void 
   */
  public static function load($class)
  {
    if(strpos($class, self::$defaultNameSpace) === false) {
      return;
    }
    
    $class = str_replace(self::$defaultNameSpace, '', $class);
    $class = str_replace("\\", "/", $class);
    $class = str_replace("_", "-", $class);
    
    $classPath = explode('/', $class);
    
    $classFile = 'class-' . strtolower(array_pop($classPath));

    $classPath = strtolower(implode('/', $classPath));
    $classPath .= strlen($classPath) > 0 ? '/' : '';

    $classFile = self::$defaultDir . $classPath . $classFile . '.php';
    
    if(file_exists($classFile)) {
      include($classFile);
    }
  }
}