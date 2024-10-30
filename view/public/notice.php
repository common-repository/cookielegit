<?php
if (!defined('ABSPATH')) exit;
?>

<div class="cookie-legit-notice cookie-legit-<?php echo esc_attr(sanitize_text_field($banner['type'])); ?> cookie-legit-position-<?php echo esc_attr(sanitize_text_field($banner['position'])); ?>" style="--cl-notice-background: <?php echo esc_attr(sanitize_hex_color($banner['style']['background_color'])) ?>;--cl-notice-color: <?php echo esc_attr(sanitize_hex_color($banner['style']['color'])); ?>;--cl-notice-radius: <?php echo esc_attr(sanitize_text_field($banner['style']['border_radius'])); ?>px" data-position="<?php echo esc_attr(sanitize_text_field($banner['position'])); ?>" data-type="<?php echo esc_attr(sanitize_text_field($banner['type'])); ?>">
    <div class="cookie-legit-notice-inner">
        <p>
            <?php echo esc_html(sanitize_text_field($banner['text'])) ?>
            <a class="cookie-legit-privacy-link" href="<?php echo esc_url(sanitize_url($privacy_link['link'])); ?>" style="--cl-privacy-link-color: <?php echo esc_url(sanitize_url($privacy_link['style']['color'])); ?>;"><?php echo esc_html(sanitize_text_field($privacy_link['text'])); ?></a>
        </p>
        <div class="cookie-legit-actions">
            <?php if ($user_opt) : ?>
                <button type="button" class="cookie-legit-btn cookie-legit-pref-btn" style="--cl-pref-btn-background: <?php echo esc_attr(sanitize_hex_color($preference_button['style']['background_color'])); ?>; --cl-pref-btn-color: <?php echo esc_attr(sanitize_hex_color($preference_button['style']['color'])); ?>; --cl-pref-btn-radius: <?php echo esc_attr(sanitize_text_field($preference_button['style']['border_radius'])); ?>px;"><?php echo esc_html(sanitize_text_field($preference_button['text'])); ?></button>
            <?php else : ?>
                <button type="button" class="cookie-legit-btn cookie-legit-deny-btn" style="--cl-deny-btn-background: <?php echo esc_attr(sanitize_hex_color($deny_button['style']['background_color'])); ?>; --cl-deny-btn-color: <?php echo esc_attr(sanitize_hex_color($deny_button['style']['color'])); ?>; --cl-deny-btn-radius: <?php echo esc_attr(sanitize_text_field($deny_button['style']['border_radius'])); ?>px;"><?php echo esc_attr(sanitize_text_field($deny_button['text'])); ?></button>
            <?php endif; ?>
            <button type="button" class="cookie-legit-btn cookie-legit-accept-btn" style="--cl-accept-btn-background: <?php echo esc_attr(sanitize_hex_color($accept_button['style']['background_color'])); ?>; --cl-accept-btn-color: <?php echo esc_attr(sanitize_hex_color($accept_button['style']['color'])); ?>; --cl-accept-btn-radius: <?php echo esc_attr(sanitize_text_field($accept_button['style']['border_radius'])); ?>px;"><?php echo esc_html(sanitize_text_field($accept_button['text'])); ?></button>
        </div>
    </div>
</div>
<?php if ($user_opt) : ?>
    <div class="cookie-legit-preferences cookie-legit-<?php echo esc_attr(sanitize_text_field($banner['type'])); ?> cookie-legit-position-<?php echo esc_attr(sanitize_text_field($banner['position'])); ?>" data-position="<?php echo esc_attr(sanitize_text_field($banner['position'])); ?>" data-type="<?php echo esc_attr(sanitize_text_field($banner['type'])); ?>">
        <div class="cookie-legit-preference-content" style="--cl-notice-background: <?php echo esc_attr(sanitize_hex_color($banner['style']['background_color'])) ?>;--cl-notice-color: <?php echo esc_attr(sanitize_hex_color($banner['style']['color'])); ?>;--cl-notice-radius: <?php echo esc_attr(sanitize_text_field($banner['style']['border_radius'])); ?>px">
            <div class="cookie-legit-preference-excerpt">
                <?php foreach ($cookie_type_texts as $type => $type_content) : ?>
                    <div class="cookie-legit-type-text">
                        <div class="cookie-legit-type-header">
                            <p><?php echo esc_html(sanitize_text_field($type_content['title'])); ?></p>
                            <label class="cookie-legit-toggle-wrapper" for="cookie-legit-toggle-<?php echo esc_attr(sanitize_key($type)); ?>">
                                <input class="cookie-legit-preference-toggle" type="checkbox" name="cl_<?php echo esc_attr(sanitize_key($type)); ?>" id="cookie-legit-toggle-<?php echo esc_attr(sanitize_key($type)); ?>" <?php echo esc_attr($type === 'essential' ? 'checked disabled' : ''); ?>>
                                <span class="cookie-legit-toggle" style="--cl-accept-btn-background: <?php echo esc_attr(sanitize_hex_color($accept_button['style']['background_color'])); ?>; --cl-accept-btn-color: <?php echo esc_attr(sanitize_hex_color($accept_button['style']['color'])); ?>;"></span>
                            </label>
                        </div>
                        <div class="cookie-legit-type-description">
                            <p><?php echo esc_attr(sanitize_textarea_field($type_content['description'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if ($give_some_love) : ?>
                    <a class="give-some-love-link" href="<?php echo esc_attr(COOKIE_LEGIT_SITE_URL); ?>" target="_blank">
                        <img src="<?php echo esc_attr(COOKIE_LEGIT_URL); ?>/assets/images/cookie-legit-logo.svg" alt="CookieLegit logo" />
                        <span><?php esc_html_e("Powered by", 'cookie-legit'); ?> CookieLegit</span>
                    </a>
                <?php endif; ?>
            </div>
            <div class="cookie-legit-preference-actions">
                <button type="button" class="cookie-legit-btn cookie-legit-accept-pref-btn" style="--cl-accept-btn-background: <?php echo esc_attr(sanitize_hex_color($accept_button['style']['background_color'])); ?>; --cl-accept-btn-color: <?php echo esc_attr(sanitize_hex_color($accept_button['style']['color'])); ?>; --cl-accept-btn-radius: <?php echo esc_attr(sanitize_text_field($accept_button['style']['border_radius'])); ?>px;"><?php echo esc_html(sanitize_text_field($accept_button['text'])); ?></button>
                <button type="button" class="cookie-legit-btn cookie-legit-save-pref-btn" style="--cl-save-pref-btn-background: <?php echo esc_attr(sanitize_hex_color($save_preference_button['style']['background_color'])); ?>; --cl-save-pref-btn-color: <?php echo esc_attr(sanitize_hex_color($save_preference_button['style']['color'])); ?>; --cl-save-pref-btn-radius: <?php echo esc_attr(sanitize_text_field($save_preference_button['style']['border_radius'])); ?>px;"><?php echo esc_html(sanitize_text_field($save_preference_button['text'])); ?></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="cookie-legit-preferences-change" style="--icon-color: #fff; --background-color: #59368c;">
    <div class="cookie-legit-pref-icon-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M257.5 27.6c-.8-5.4-4.9-9.8-10.3-10.6v0c-22.1-3.1-44.6 .9-64.4 11.4l-74 39.5C89.1 78.4 73.2 94.9 63.4 115L26.7 190.6c-9.8 20.1-13 42.9-9.1 64.9l14.5 82.8c3.9 22.1 14.6 42.3 30.7 57.9l60.3 58.4c16.1 15.6 36.6 25.6 58.7 28.7l83 11.7c22.1 3.1 44.6-.9 64.4-11.4l74-39.5c19.7-10.5 35.6-27 45.4-47.2l36.7-75.5c9.8-20.1 13-42.9 9.1-64.9v0c-.9-5.3-5.3-9.3-10.6-10.1c-51.5-8.2-92.8-47.1-104.5-97.4c-1.8-7.6-8-13.4-15.7-14.6c-54.6-8.7-97.7-52-106.2-106.8zM208 144a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM144 336a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm224-64a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
        </svg>
    </div>
</div>
