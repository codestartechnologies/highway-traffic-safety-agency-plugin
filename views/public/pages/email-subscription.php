<?php

global $wpdb;
$check = false;

// process request made using GET
if ( isset( $_GET['action'] ) && in_array( $_GET['action'], array( 'unsubscribe' ), true ) ) {
  $email = isset( $_GET['email'] ) ? wp_strip_all_tags( $_GET['email'] ) : null;
  $token = isset( $_GET['token'] ) ? urldecode( $_GET['token'] ) : null;
  $table_name = HTSA_PLUGIN_DB_TABLE_PREFIX . 'newsletters';

  // Check if database table exists
  if ( ! wps_db_table_exists( $table_name ) ) {
    $check_message = 'Database table does not exists!';
  } else {
    // Get valid subscriber details from database
    $subscriber = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `{$table_name}` WHERE email=%s AND valid=%d", array( $email, 1 ) ) );

    if ( is_null( $email ) || is_null( $token ) ) {
      $check_message = 'Email and token not set!';
    } elseif ( is_null( $subscriber ) ) {
      $check_message = 'This email is yet to be subscribed/registered!';
    } else {
      $token_arr = explode( '|', $token );
      $md5_hash = $token_arr[0] ?? null;
      $site_hash = $token_arr[1] ?? null;

      // Verify token is correct
      if ( ( md5( $subscriber->id . $subscriber->created_at ) !== $md5_hash ) || ( ! password_verify( HTSA_EMAIL_VALIDATE_SECRET, $site_hash ) ) ) {
        $check_message = 'Signature token is invalid!';
      } else {
        // Remove subscription from database
        $deleted = $wpdb->delete( $table_name, array( 'id' => $subscriber->id ), array( '%d' ) );
        $check = ( $deleted ) ? true : false;
        $check_message = ( $deleted ) ? 'Subscription removed successfully' : 'Database error occured! Subscription could not be removed!';
      }
    }
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

        <?php if ( isset( $check_message ) ) : ?>

        <div class="alert <?php echo ( $check ) ? 'alert-success' : 'alert-danger'; ?> text-center">
          <?php printf( esc_html__( '%s', 'htsa-plugin' ), $check_message ); ?>
        </div>

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