<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

$email = $meta_value['email'] ?? null;
$phone = $meta_value['phone'] ?? null;

?>

<p>
    <label for="htsa_officer_contact_email"> <?php esc_html_e( 'Email Address:', 'htsa-plugin' ); ?></label><br /><br />
    <input type="email" name="<?php echo $meta_key; ?>[email]" id="htsa_officer_contact_email" class="widefat"
        value="<?php echo esc_attr( $email ); ?>" required />
</p>

<p>
    <label for="htsa_officer_contact_phone"> <?php esc_html_e( 'Phone Number:', 'htsa-plugin' ); ?></label><br /><br />
    <input type="text" name="<?php echo $meta_key; ?>[phone]" id="htsa_officer_contact_phone" class="widefat"
        value="<?php echo esc_attr( $phone ); ?>" required />
</p>
