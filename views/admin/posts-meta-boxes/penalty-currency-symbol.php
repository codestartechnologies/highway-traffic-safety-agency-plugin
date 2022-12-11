<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

$meta_value = ( empty( $meta_value ) ) ? '&#8358;' : $meta_value;

?>

<p>
    <input type="text" name="<?php echo $meta_key; ?>" id="htsa_currency_symbol" value="<?php echo esc_attr( $meta_value ); ?>"
        placeholder="<?php esc_attr_e( 'Example: $', 'htsa-plugin' ); ?>" class="widefat" required />
</p>
