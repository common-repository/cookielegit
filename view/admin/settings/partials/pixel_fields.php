<?php
if (!defined('ABSPATH')) exit;
?>
<input type="hidden" name="option_name" value="<?php echo esc_attr($pixel_settings_key) ?>">
<input type="hidden" name="settings_key" value="pixels">
<div class="cl-form-header">
    <h3><?php esc_html_e('Pixel settings', 'cookie-legit'); ?></h3>
    <button><?php esc_html_e('Save settings', 'cookie-legit'); ?></button>
</div>
<div class="cl-form-content">
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label><?php esc_html_e('Google tag manager consent mode', 'cookie-legit'); ?></label>
            <p><?php esc_html_e('Enable this if you use consent mode v2 in Google tag manager.', 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <div class="cl-toggle-input">
                <input type="checkbox" name="pixels_settings[consent_mode]" id="pixel-settings-consent-mode" <?php if ($consent_mode) {
                                                                                                                    echo esc_attr('checked');
                                                                                                                } ?>>
                <label for="pixel-settings-consent-mode"></label>
            </div>
        </div>
    </div>
    <?php foreach ($pixel_settings['codes'] as $pixel_name => $pixel) : ?>
        <div class="cl-form-row row-pixel row-<?php echo esc_attr(sanitize_key($pixel_name)); ?> <?php if ($consent_mode && $pixel_name !== 'google_tag_manager') {
                                                                                                            echo esc_attr('hide');
                                                                                                        } ?>">
            <div class="cl-label-wrapper">
                <label for="pixel-<?php echo esc_attr(sanitize_key($pixel_name)); ?>-value"><?php echo esc_html(ucfirst(str_replace('_', ' ', sanitize_key($pixel_name)))); ?></label>
                <p><?php
                    esc_html(
                        printf(
                            "Give us your %s tracking code identifier and we'll take care of the rest",
                            'cookie-legit'
                        ),
                        ucfirst(str_replace('_', ' ', sanitize_key($pixel_name)))
                    ); ?></p>
            </div>
            <div class="cl-values-wrapper">
                <div class="cl-text-input cl-flex-col">
                    <input type="text" name="pixels_settings[codes][<?php echo esc_attr(sanitize_key($pixel_name)) ?>]" id="pixel-<?php echo esc_attr(sanitize_key($pixel_name)) ?>-value" value="<?php echo esc_attr(sanitize_text_field($pixel)); ?>">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="cl-form-row cl-just-end">
        <div class="cl-submit-button">
            <button class="cl-primary-button" type="submit"><?php esc_html_e('Save settings', 'cookie-legit'); ?></button>
        </div>
    </div>
</div>