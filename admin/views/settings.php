<?php

    // No direct access to this file
    defined( 'ABSPATH' ) or die();

?>

<?php if ( isset( $_GET['settings-updated'] ) ) : ?>

    <?php if ( get_option('browsee_project_key') == '' ): ?>
        <div id="message" class="notice notice-warning is-dismissible">
            <p><strong><?php _e('Browsee script is disabled.', 'browsee'); ?></strong></p>
        </div>
    <?php else: ?>
        <div id="message" class="notice notice-success is-dismissible">
            <p><strong><?php echo sprintf( __('Browsee script installed for project %s.', 'browsee'), get_option('browsee_project_key') ); ?></strong></p>
        </div>
    <?php endif; ?>

<?php endif; ?>


<div id="business-info-wrap" class="wrap">

    <div class="wp-header">
        <img src="<?php echo plugins_url( '../static/browsee_logo_2x.png', __FILE__); ?>" alt="<?php echo __('A session replay is worth a thousand events.', 'browsee'); ?>" class="browsee-header">
    </div>



    <form method="post" action="options.php">
        <?php settings_fields( 'browsee' );
        do_settings_sections('browsee'); ?>

        <div id="browsee-form-area">
            <p><?php
            $url = 'https://browsee.io/app/settings';
            $link = sprintf( wp_kses( __( 'Get your Project Key from your <a href="%s" target="_blank">Browsee dashboard</a>.', 'browsee'), array(  'a' => array( 'href' => array(), 'target' =>  '_blank' ) ) ), esc_url( $url ) );
            echo $link;
            ?></p>
            <p><?php _e('Copy your Browsee Project Key below to add Browsee to your WordPress site.', 'browsee'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                        <label for="browsee_project_key"><?php esc_html_e( 'Browsee ID', 'browsee'); ?></label>
                        </th>

                        <td>
                        <input name="browsee_project_key" id="browsee_project_key" value="<?php echo esc_attr( get_option('browsee_project_key') ); ?>" />
                        <p class="description" id="wp_browsee_project_key_description"><?php esc_html_e( '(Leave blank to disable)', 'browsee' ); ?></p>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

        <?php submit_button(); ?>

    </form>
</div>
