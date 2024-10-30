<?php
if (!defined('ABSPATH')) exit;
?>
<input type="hidden" name="option_name" value="<?php echo esc_attr(sanitize_key($blocking_settings_key)) ?>">
<input type="hidden" name="settings_key" value="blocking">
<div class="cl-form-header">
    <h3>
        <?php esc_html_e('Blocking settings', 'cookie-legit'); ?>
        <?php if (cookie_legit_is_translatable() && !empty(cookie_legit_current_language())) : ?>
            <span class="cl-language-indicator">(<?php echo esc_html(cookie_legit_current_language()); ?>)</span>
        <?php endif; ?>
    </h3>
    <button><?php esc_html_e('Save settings', 'cookie-legit'); ?></button>
</div>
<div class="cl-form-content">
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label for=""><?php esc_html_e('Iframe\'s', 'cookie-legit'); ?></label>
            <p><?php esc_html_e('Prevent iframe\'s from loading an placing unwanted cookies.', 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper cl-flex-col">
            <div class="cl-value-wrapper">
                <label for="iframe-blocking"><?php esc_html_e("Block Iframe's", 'cookie-legit'); ?></label>
                <div class="cl-toggle-input">
                    <input type="checkbox" name="blocking_settings[iframes][block]" id="iframe-blocking" <?php if (isset($blocking_settings['iframes']['block']) && $blocking_settings['iframes']['block'] === 'on') {
                                                                                                                echo esc_attr('checked');
                                                                                                            } ?>>
                    <label for="iframe-blocking"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label for=""><?php esc_html_e('Iframe overlay', 'cookie-legit'); ?></label>
            <p><?php esc_html_e("This overlay will appear when Iframe's are blocked", 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <div class="cl-value-wrapper cl-mb-1">
                <label for="iframe-overlay-text"><?php esc_html_e('Overlay text', 'cookie-legit') ?></label>
                <div class="cl-textarea">
                    <textarea name="blocking_settings[iframes][overlay][text]" id="iframe-overlay-text" rows="2"><?php echo esc_textarea(sanitize_textarea_field($blocking_settings['iframes']['overlay']['text'])); ?></textarea>
                </div>
            </div>
            <div class="cl-flex-row">
                <div class="cl-color-input cl-flex-col cl-mr-3">
                    <label for="iframe-background-color"><?php esc_html_e('Background', 'cookie-legit') ?></label>
                    <input type="color" name="blocking_settings[iframes][overlay][style][background_color]" value="<?php echo esc_textarea(sanitize_text_field($blocking_settings['iframes']['overlay']['style']['background_color'])); ?>" id="iframe-background-color">
                </div>
                <div class="cl-color-input cl-flex-col cl-mr-3">
                    <label for="iframe-color">Color</label>
                    <input type="color" name="blocking_settings[iframes][overlay][style][color]" value="<?php echo esc_attr(sanitize_hex_color($blocking_settings['iframes']['overlay']['style']['color'])); ?>" id="privacy-link-color">
                </div>
            </div>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label for=""><?php esc_html_e('Script blocking', 'cookie-legit'); ?></label>
            <p><?php esc_html_e("Prevent scripts from loading when your user hasn't accepted cookies yet", 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <label for="script-blocking"><?php esc_html_e("Block scripts", 'cookie-legit'); ?></label>
            <div class="cl-toggle-input">
                <input type="checkbox" name="blocking_settings[scripts][block]" id="script-blocking" <?php if (isset($blocking_settings['scripts']['block']) && $blocking_settings['scripts']['block'] === 'on') {
                                                                                                            echo esc_attr('checked');
                                                                                                        } ?>>
                <label for="script-blocking"></label>
            </div>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label for=""><?php esc_html_e("Exclude scripts", 'cookie-legit'); ?></label>
            <p><?php esc_html_e('Exclude scripts from being blocked, some scripts might be necessary to let your site function. One script per line.', 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <div class="cl-textarea">
                <textarea name="blocking_settings[scripts][excludes]" id="" rows="6"><?php echo esc_textarea(sanitize_textarea_field($blocking_settings['scripts']['excludes'])); ?></textarea>
            </div>
        </div>
    </div>
</div>
