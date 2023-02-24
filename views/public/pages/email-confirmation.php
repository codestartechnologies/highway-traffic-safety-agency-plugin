<?php

// process request

$check = false;

if ( isset( $_GET['email'] ) && isset( $_GET['token'] ) ) {
    $email = wp_strip_all_tags( $_GET['email'] );
    $token = wp_strip_all_tags( $_GET['token'] );
    $table_name = HTSA_PLUGIN_DB_TABLE_PREFIX . 'newsletters';
    $check = true;
    $check_message = 'An error occured while verifying your email address. Please retry again.';

    if ( wps_db_table_exists( $table_name ) ) {
      global $wpdb;

      // Check if email exists and is valid
      $exists = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM `{$table_name}` WHERE email=%s AND token=%s AND valid=%d",
        array( $email, $token, 0 )
      ) );

      if ( intval( $exists ) === 1 ) {
        // update database
        $verified = $wpdb->update(
          $table_name,
          array(
            'valid'   => 1,
            'token'   => '',
          ),
          array(
            'email'   => $email,
          ),
          array( '%d', '%s' ),
          array( '%s' )
        );
      }

      $check_message = ( isset( $verified ) && $verified ) ? 'Your email address has been confirmed successfully!' : $check_message;
    }
}

get_header();

?>

<style>

.alert {
  --bs-alert-bg: transparent;
  --bs-alert-padding-x: 1rem;
  --bs-alert-padding-y: 1rem;
  --bs-alert-margin-bottom: 1rem;
  --bs-alert-color: inherit;
  --bs-alert-border-color: transparent;
  --bs-alert-border: 1px solid var(--bs-alert-border-color);
  --bs-alert-border-radius: 0.375rem;
  position: relative;
  padding: var(--bs-alert-padding-y) var(--bs-alert-padding-x);
  margin-bottom: var(--bs-alert-margin-bottom);
  color: var(--bs-alert-color);
  background-color: var(--bs-alert-bg);
  border: var(--bs-alert-border);
  border-radius: var(--bs-alert-border-radius);
}

.alert-heading {
  color: inherit;
}

.alert-link {
  font-weight: 700;
}

.alert-dismissible {
  padding-right: 3rem;
}
.alert-dismissible .btn-close {
  position: absolute;
  top: 0;
  right: 0;
  z-index: 2;
  padding: 1.25rem 1rem;
}

.alert-primary {
  --bs-alert-color: #084298;
  --bs-alert-bg: #cfe2ff;
  --bs-alert-border-color: #b6d4fe;
}
.alert-primary .alert-link {
  color: #06357a;
}

.alert-success {
  --bs-alert-color: #0f5132;
  --bs-alert-bg: #d1e7dd;
  --bs-alert-border-color: #badbcc;
}
.alert-success .alert-link {
  color: #0c4128;
}

.alert-danger {
  --bs-alert-color: #842029;
  --bs-alert-bg: #f8d7da;
  --bs-alert-border-color: #f5c2c7;
}
.alert-danger .alert-link {
  color: #6a1a21;
}

</style>

<div class="ui hidden section divider"></div>

<section>

    <div class="container">

        <h3 class="ui horizontal section divider"> <?php esc_html_e( 'Email Confirmation', 'htsa-plugin' ); ?> </h3>

        <?php if ( $check ) : ?>

        <div class="alert alert-primary text-center"><?php printf( esc_html__( '%s', 'htsa-plugin' ), $check_message ); ?></div>

        <?php else : ?>

            <div>
                <center>
                    <h3><?php esc_html_e( 'This page is expired!', 'htsa-plugin' ); ?></h3>
                </center>
            </div>
            <div class="ui hidden section divider"></div>

        <?php endif; ?>

    </div>

</section>

<div class="ui hidden section divider"></div>

<?php get_footer(); ?>