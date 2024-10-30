<?php
if (!defined('ABSPATH')) exit;

$esc_tracking_code = esc_js(sanitize_text_field($tracking_code));
echo wp_json_encode(array(
    "scripts" => [
        "_linkedin_partner_id = '{$esc_tracking_code}';
        window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
        window._linkedin_data_partner_ids.push(_linkedin_partner_id);",
        '(function(l) {
            if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
            window.lintrk.q=[]}
            var s = document.getElementsByTagName("script")[0];
            var b = document.createElement("script");
            b.type = "text/javascript";b.async = true;
            b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
            s.parentNode.insertBefore(b, s);})(window.lintrk);'
    ]
));