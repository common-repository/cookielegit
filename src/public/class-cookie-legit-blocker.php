<?php

namespace Cookie_Legit\Public;

use Cookie_Legit\Models\Cookie_Legit_Settings;

class Cookie_Legit_Blocker
{
    /**
     * Intercept scripts if script blocking is set
     * @param string $tag 
     * @param string $handle 
     * @param string $src 
     * @return string 
     */
    public static function maybe_block_scripts($tag, $handle, $src)
    {
        $blocking_settings = Cookie_Legit_Settings::get_blocking_settings(false);

        if(is_admin() || empty($blocking_settings) || isset($blocking_settings["scripts"]["block"]) && !$blocking_settings['scripts']["block"]) {
            return $tag;
        }

        $excludes = explode("\n", $blocking_settings["scripts"]["excludes"]);
        $excludes = array_merge($excludes, [
            'jquery',
            'cookie-legit'
        ]);

        $pass = array_filter($excludes, fn($part) => strpos($src, $part));
        if(count($pass) > 0) {
            return $tag;
        }

        if(strpos(needle: "type", haystack: $tag) !== false) {
            return preg_replace(pattern: "/type\=\"(.*)\"/", replacement: "type=\"cookielegitblock\" data-cl-type=\"$1\"", subject: $tag);
        }

        return str_replace(search: 'src', replace: 'type="cookielegitblock" data-cl-type="text/javascript" src', subject: $tag);
    }

    /**
     * Block iframes is set
     * @param mixed $content
     * @return mixed
     */
    public static function maybe_block_iframes($content)
    {
        $blocking_settings = Cookie_Legit_Settings::get_blocking_settings(false);

        if(is_admin() || empty($blocking_settings) || !$blocking_settings['iframes']["block"]) {
            return $content;
        }

        preg_match_all("/\<iframe.*?(src\=\"(.*?))\"/", $content, $iframes);

        if(empty($iframes[0])) {
            return $content;
        }

        $custom_style = "color:".$blocking_settings["iframes"]["overlay"]["style"]["color"].";background-color:".$blocking_settings["iframes"]["overlay"]["style"]["background_color"].";";
        $new_src = "data:text/html;base64," . base64_encode('<div style="font-size:16px;width:100%;height:100%;display:flex;justify-content:center;align-items:center;'.$custom_style.'">'.$blocking_settings["iframes"]["overlay"]["text"].'</div>');

        foreach($iframes[0] as $key => $iframe) {
            $original_src = $iframes[2][$key];

            $new_frame = str_replace($original_src, $new_src, $iframe);
            $new_frame .= " data-cl-src=\"{$original_src}\"";

            $content = str_replace($iframe, $new_frame, $content);
        }

        return $content;
    }
}
