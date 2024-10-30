<?php

namespace Cookie_Legit;

class Cookie_Legit_View_Loader
{

    /**
     * Load views to display
     * @param string $view The view to load, use . to navigate folders inside the view folder
     * @param array $data The data to pass to the view
     * @return void 
     */
    public static function load(String $view = 'index', Array $data = array(), $print = true)
    {
        $view_path = implode('/',explode('.', $view)) . '.php';

        ob_start();
        extract($data);

        if(is_admin() && !wp_doing_ajax()) {
            include COOKIE_LEGIT_PATH . 'view/admin/partials/cl-header.php';
        }

        include COOKIE_LEGIT_PATH . 'view/' . $view_path;
        
        if(is_admin()  && !wp_doing_ajax()) {
            include COOKIE_LEGIT_PATH . 'view/admin/partials/cl-footer.php';
        }

        $content = ob_get_clean();
        
        if($print) {
            print wp_kses($content, self::allowed_html());
        }

        return wp_kses($content, self::allowed_html());
    }

    /**
     * Check if a view exists
     * @param string $view 
     * @return void 
     */
    public static function exists(String $view)
    {
        $view_path = COOKIE_LEGIT_PATH . 'view/' . implode('/',explode('.', $view)) . '.php';
        return is_file($view_path);
    }

    private static function allowed_html()
    {
        return array_merge(wp_kses_allowed_html('post'), array(
            'input' => array(
                'class' => 1,
                'id' => 1,
                'type' => 1,
                'name' => 1,
                'value' => 1,
                'checked' => 1,
                'style' => 1,
                'aria-label' => 1,
            ),
            'form' => array(
                'action' => 1,
                'method' => 1,
                'class' => 1,
                'id' => 1,
            ),
            'svg' => array(
                'xmlns' => 1,
                'viewbox' => 1
            ),
            'path' => array(
                'd' => 1
            ),
            'script' => array()
        ));
    }
}
