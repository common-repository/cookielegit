<?php
if (!defined('ABSPATH')) exit;
?>
<?php if (cookie_legit_is_translatable() && empty(cookie_legit_current_language())) : ?>
    <div class="cl-alert cl-alert-danger">
        <span><?php esc_html_e("You are currently editing the settings for all languages, this has no effect!", 'cookie-legit') ?></span>
    </div>
<?php endif; ?>
<div class="cookie-legit-content">
    <div class="settings-menu-wrapper">
        <ul class="settings-menu">
            <li class="settings-menu-item <?php echo esc_attr($active_screen === 'notice' || $active_screen === false ? 'active' : ''); ?>"><a href="?page=<?php echo esc_attr( COOKIE_LEGIT_SLUG ); ?>&s=notice"><?php esc_html_e('Notice settings', 'cookie-legit'); ?></a></li>
            <li class="settings-menu-item <?php echo esc_attr( $active_screen === 'pixel' ? 'active' : '' ); ?>"><a href="?page=<?php echo esc_attr(COOKIE_LEGIT_SLUG); ?>&s=pixel"><?php esc_html_e('Pixel settings', 'cookie-legit'); ?></a></li>
            <li class="settings-menu-item <?php echo esc_attr( $active_screen === 'blocking' ? 'active' : '' ); ?>"><a href="?page=<?php echo esc_attr(COOKIE_LEGIT_SLUG); ?>&s=blocking"><?php esc_html_e('Blocking', 'cookie-legit'); ?></a></li>
            <li class="settings-menu-item <?php echo esc_attr( $active_screen === 'additional' ? 'active' : '' ); ?>"><a href="?page=<?php echo esc_attr(COOKIE_LEGIT_SLUG); ?>&s=additional"><?php esc_html_e('Additional', 'cookie-legit'); ?></a></li>
        </ul>
    </div>
    <div class="settings-wrapper">
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="cl-settings-form">
            <?php wp_nonce_field('cl_save_settings', '_cl_save_settings_nonce'); ?>
            <input type="hidden" name="action" value="cl_save_settings">
            <?php
            switch ($active_screen) {
                case 'notice':
                    include COOKIE_LEGIT_PATH . '/view/admin/settings/partials/notice_fields.php';
                    break;
                case 'pixel':
                    include COOKIE_LEGIT_PATH . '/view/admin/settings/partials/pixel_fields.php';
                    break;
                case 'blocking':
                    include COOKIE_LEGIT_PATH . '/view/admin/settings/partials/block_fields.php';
                    break;
                case 'additional':
                    include COOKIE_LEGIT_PATH . '/view/admin/settings/partials/additional_fields.php';
                    break;
                default:
                    include COOKIE_LEGIT_PATH . '/view/admin/settings/partials/notice_fields.php';
                    break;
            }
            ?>
        </form>
    </div>
</div>
