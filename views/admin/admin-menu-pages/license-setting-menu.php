<?php
/**
 * $page     - Passed to the view by WPSSettingMenu Class.
 */

$license_status = get_option( 'htsa_plugin_license_valid' );
$activation_status = get_option( 'htsa_plugin_license_activated' );
$deactivation_status = get_option( 'htsa_plugin_license_deactivated' );

$refresh_link = add_query_arg(
    '_wpnonce',
    wp_create_nonce( 'htsa-plugin-license-api' ),
    admin_url( 'options-general.php?page=htsa-plugin-license-setting&action=license-status' )
);

$activation_link = add_query_arg(
    '_wpnonce',
    wp_create_nonce( 'htsa-plugin-license-api' ),
    admin_url( 'options-general.php?page=htsa-plugin-license-setting&action=activate-license' )
);

$deactivation_link = add_query_arg(
    '_wpnonce',
    wp_create_nonce( 'htsa-plugin-license-api' ),
    admin_url( 'options-general.php?page=htsa-plugin-license-setting&action=deactivate-license' )
);

$api_response = htsa_plugin_get_session_data( 'htsa_plugin_license_api' );
htsa_plugin_destroy_session_data( 'htsa_plugin_license_api' );

?>

<div class="wrap">

    <?php
        if ( ! is_null( $api_response ) ) {
            htsa_plugin_license_api_notice( $api_response );
        }
    ?>

    <form action="<?php echo esc_attr( admin_url( 'options.php') ); ?>" method="post">

        <?php

            settings_fields( $page );

            do_settings_sections( $page );

            submit_button();

        ?>

    </form>

    <br>

    <div>
        <a href="<?php echo $refresh_link; ?>" class="button">Refresh License</a>
        <a href="<?php echo $activation_link; ?>" class="button button-primary" <?php echo ( $activation_status === true ) ? 'disabled' : null ?>>Activate License</a>
        <a href="<?php echo $deactivation_link; ?>" class="button button-primary" <?php echo ( $deactivation_status === true ) ? 'disabled' : null ?>>Deactivate License</a>
    </div>

</div>
