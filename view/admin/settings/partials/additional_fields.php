<?php
if (!defined('ABSPATH')) exit;
?>
<input type="hidden" name="option_name" value="<?php echo esc_attr(sanitize_key($additional_settings_key)); ?>">
<input type="hidden" name="settings_key" value="additional">
<div class="cl-form-header">
    <h3><?php esc_html_e('Additional settings', 'cookie-legit'); ?></h3>
    <button><?php esc_html_e('Save settings', 'cookie-legit'); ?></button>
</div>
<div class="cl-form-content">
    <div class="cl-form-row">
        <div class="cl-label-wrapper">
            <label for="give-love"><?php esc_html_e('Give us some love', 'cookie-legit') ?></label>
            <p><?php esc_html_e('This option will add our logo under the explanation about cookies in the preferences screen. We would appreciate it much!', 'cookie-legit'); ?></p>
        </div>
        <div class="cl-values-wrapper">
            <div class="cl-toggle-input">
                <input type="checkbox" name="additional_settings[give_some_love]" id="give-love" <?php if (isset($additional_settings['give_some_love']) && $additional_settings['give_some_love']) { echo esc_attr('checked'); } ?>>
                <label for="give-love"></label>
            </div>
        </div>
    </div>
</div>