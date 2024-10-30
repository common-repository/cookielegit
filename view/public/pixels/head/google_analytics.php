<?php
if (!defined('ABSPATH')) exit;

$esc_tracking_code = esc_js(sanitize_text_field($tracking_code));
echo wp_json_encode(array(
    "srcs" => [
        "https://www.googletagmanager.com/gtag/js?id={$esc_tracking_code}"
    ],
    "scripts" => [
        "window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{$esc_tracking_code}');"
    ]
));
