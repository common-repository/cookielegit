<?php
if (!defined('ABSPATH')) exit;
?>
<input type="hidden" name="option_name" value="<?php
                                                echo esc_attr( $notice_settings_key ); ?>">
<input type="hidden" name="settings_key" value="notice">
<div class="cl-form-header">
    <h3>
        <?php esc_html_e('Notice settings', 'cookie-legit'); ?>
        <?php if (cookie_legit_is_translatable() && !empty(cookie_legit_current_language())) : ?>
            <span class="cl-language-indicator">(<?php echo esc_html(cookie_legit_current_language()); ?>)</span>
        <?php endif; ?>
    </h3>
    <button><?php esc_html_e('Save settings', 'cookie-legit'); ?></button>
</div>
<div class="cl-form-content">
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label><?php esc_html_e('Notice type', 'cookie-legit'); ?></label>
            <p><?php esc_html_e('This is type of banner that will be display when the user first visits your site.', 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <div class="cl-radio-inputs">
                <?php foreach ($notice_types as $notice_type) : ?>
                    <div class="cl-radio-input-wrapper">
                        <input class="notice-type-option" type="radio" id="notice-settings-banner-type-<?php echo esc_attr( $notice_type['type'] ); ?>" name="notice_settings[banner][type]" value="<?php echo esc_attr( sanitize_text_field($notice_type['type']) ); ?>" <?php echo esc_attr( $notice_type['type'] === $notice_settings['banner']['type'] ? 'checked' : '' );  ?>>
                        <label for="notice-settings-banner-type-<?php echo esc_attr( $notice_type['type'] ) ?>">
                            <?php echo esc_html(Cookie_Legit\Models\Cookie_Legit_Settings::get_translated_notice_type($notice_type['type'])); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label><?php esc_html_e('Notice position', 'cookie-legit'); ?></label>
            <p><?php esc_html_e('This controls the position of the cookie notice.', 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <?php foreach ($notice_types as $notice_type) : ?>
                <div class="cl-radio-inputs banner-position-options <?php echo esc_attr( $notice_type['type'] !== $notice_settings['banner']['type'] ? 'hide' : '' ); ?>" data-notice-type="<?php echo esc_attr( sanitize_text_field($notice_type['type']) ); ?>">
                    <?php foreach ($notice_type['positions'] as $position => $position_label) : ?>
                        <div class="cl-radio-input-wrapper">
                            <input type="radio" id="notice-settings-banner-type-<?php echo esc_attr( $notice_type['type'] ) ?>-<?php echo esc_attr( $position ) ?>" name="notice_settings[banner][position]" value="<?php echo esc_attr( sanitize_text_field($position) ); ?>" <?php echo esc_attr( $position === $notice_settings['banner']['position'] ? 'checked' : '' );  ?>>
                            <label for="notice-settings-banner-type-<?php echo esc_attr( $notice_type['type'] ) ?>-<?php echo esc_attr( $position ); ?>">
                                <?php echo esc_html( $position_label )  ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($notice_type['positions'])) : ?>
                        <p><?php esc_html_e('The selected notice type does not have position options', 'cookie-legit') ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label for="notice-banner-text"><?php esc_html_e('Notice text', 'cookie-legit'); ?></label>
            <p><?php esc_html_e("Let your users know that you're using cookies.", 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <div class="cl-textarea">
                <textarea name="notice_settings[banner][text]" id="notice-banner-text" rows="3"><?php echo esc_html( sanitize_text_field($notice_settings['banner']['text']) ); ?></textarea>
            </div>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label><?php esc_html_e('Notice appearance', 'cookie-legit'); ?></label>
            <p><?php esc_html_e("Style the cookie notice your way.", 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper cl-flex-row cl-just-start">
            <div class="cl-color-input cl-flex-col cl-mr-3">
                <label for="notice-background-color"><?php esc_html_e('Background', 'cookie-legit'); ?></label>
                <input type="color" name="notice_settings[banner][style][background_color]" id="notice-background-color" value="<?php echo esc_attr(sanitize_hex_color($notice_settings['banner']['style']['background_color'])); ?>">
            </div>
            <div class="cl-color-input cl-flex-col cl-mr-3">
                <label for="notice-text-color"><?php esc_html_e('Text color', 'cookie-legit'); ?></label>
                <input type="color" name="notice_settings[banner][style][color]" id="notice-text-color" value="<?php echo esc_attr(sanitize_hex_color($notice_settings['banner']['style']['color'])); ?>">
            </div>
            <div class="cl-number-input cl-flex-col">
                <label for="notice-border-radius"><?php esc_html_e('Border radius', 'cookie-legit'); ?></label>
                <input type="number" name="notice_settings[banner][style][border_radius]" id="notice-background-color" value="<?php echo esc_attr(sanitize_text_field($notice_settings['banner']['style']['border_radius'])); ?>">
            </div>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label><?php esc_html_e('Privacy link', 'cookie-legit'); ?></label>
            <p><?php esc_html_e("Let users find you privacy statement.", 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper cl-flex-row cl-just-start">
            <div class="cl-text-input cl-flex-col cl-mr-3">
                <label for="privacy-link-text">Link text</label>
                <input type="text" name="notice_settings[privacy_link][text]" value="<?php echo esc_attr( sanitize_text_field($notice_settings['privacy_link']['text']) ); ?>" id="privacy-link-text">
            </div>
            <div class="cl-text-input cl-flex-col cl-mr-3">
                <label for="privacy-link-link">Link page</label>
                <input type="text" name="notice_settings[privacy_link][link]" value="<?php echo esc_attr( sanitize_text_field($notice_settings['privacy_link']['link']) ); ?>" id="privacy-link-link">
            </div>
            <div class="cl-color-input cl-flex-col">
                <label for="privacy-link-color">Link color</label>
                <input type="color" name="notice_settings[privacy_link][style][color]" value="<?php echo esc_attr( sanitize_text_field($notice_settings['privacy_link']['style']['color']) ); ?>" id="privacy-link-color">
            </div>
        </div>
    </div>
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label><?php esc_html_e('User concent', 'cookie-legit'); ?></label>
            <p><?php esc_html_e("Let users set their cookie preferences.", 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper cl-flex-row cl-just-start">
            <div class="cl-toggle-input">
                <input type="checkbox" name="notice_settings[user_opt]" id="user-opt" <?php if (isset($notice_settings['user_opt']) && $notice_settings['user_opt'] === 'on') {
                                                                                            echo esc_attr( 'checked' );
                                                                                        } ?>>
                <label for="user-opt"></label>
            </div>
        </div>
    </div>
    <?php foreach ($notice_settings['buttons'] as $button => $button_settings) : ?>
        <div class="cl-form-row">
            <div class="cl-label-wrapper">
                <label><?php esc_html(printf('%s button', 'cookie-legit'), ucfirst(str_replace('_', ' ', $button))); ?></label>
                <p><?php esc_html(printf("Change the text and style of the %s button", 'cookie-legit'), str_replace('_', ' ', $button)); ?></p>
            </div>
            <div class="cl-values-wrapper cl-flex-col">
                <div class="cl-text-input cl-flex-col cl-mb-2">
                    <label for="<?php echo esc_attr( $button ) ?>-text" class="cl-mb-1"><?php esc_html_e('Button text', 'cookie-legit') ?></label>
                    <input type="text" name="notice_settings[buttons][<?php echo esc_attr( $button ) ?>][text]" id="<?php echo esc_attr( $button ); ?>-text" value="<?php echo esc_attr( sanitize_text_field($notice_settings["buttons"][$button]["text"]) ); ?>">
                </div>
                <div class="cl-button-style cl-flex-row">
                    <div class="cl-color-input cl-flex-col cl-mr-3">
                        <label for="privacy-link-link"><?php esc_html_e('Background', 'cookie-legit') ?></label>
                        <input type="color" name="notice_settings[buttons][<?php echo esc_attr( $button ); ?>][style][background_color]" value="<?php echo esc_attr( sanitize_text_field($notice_settings['buttons'][$button]['style']['background_color']) ); ?>" id="privacy-link-link">
                    </div>
                    <div class="cl-color-input cl-flex-col cl-mr-3">
                        <label for="privacy-link-color"><?php esc_html_e('Color', 'cookie-legit') ?></label>
                        <input type="color" name="notice_settings[buttons][<?php echo esc_attr( $button ) ?>][style][color]" value="<?php echo esc_attr( sanitize_text_field($notice_settings['buttons'][$button]['style']['color']) ); ?>" id="privacy-link-color">
                    </div>
                    <div class="cl-color-input cl-flex-col">
                        <label for="privacy-link-color"><?php esc_html_e('Border radius', 'cookie-legit') ?></label>
                        <input type="number" name="notice_settings[buttons][<?php echo esc_attr( $button ) ?>][style][border_radius]" value="<?php echo esc_attr( sanitize_text_field($notice_settings['buttons'][$button]['style']['border_radius']) ); ?>" id="privacy-link-color">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php foreach ($notice_settings["texts"] as $text => $text_settings) : ?>
        <div class="cl-form-row">
            <div class="cl-label-wrapper">
                <label for="notice-banner-text"><?php esc_html(printf('%s text', 'cookie-legit'), ucfirst($text)); ?></label>
                <p><?php esc_html(printf("Let your users what %s cookies are in your own words", 'cookie-legit'), $text); ?></p>
            </div>
            <div class="cl-values-wrapper cl-flex-col">
                <div class="cl-text-input cl-flex-col cl-mb-2">
                    <label for="text-<?php echo esc_attr( $text ) ?>-title"><?php esc_html_e('Title', 'cookie-legit') ?></label>
                    <input type="text" name="notice_settings[texts][<?php echo esc_attr( $text ); ?>][title]" id="text-<?php echo esc_attr( $text ) ?>-title" value="<?php echo esc_attr( sanitize_text_field($notice_settings['texts'][$text]['title']) ); ?>">
                </div>
                <div class="cl-textarea cl-flex-col">
                    <label for="text-<?php echo esc_attr( $text ) ?>-description"><?php esc_html_e('Description', 'cookie-legit'); ?></label>
                    <textarea name="notice_settings[texts][<?php echo esc_attr( $text ); ?>][description]" id="text-<?php echo esc_attr( $text ) ?>-description" rows="3"><?php echo esc_attr( sanitize_text_field($notice_settings['texts'][$text]['description']) ); ?></textarea>
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
