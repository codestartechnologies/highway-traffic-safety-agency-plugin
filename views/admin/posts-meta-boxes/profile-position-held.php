<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

?>

<p>
    <input type="text" name="<?php echo $meta_key; ?>" id="htsa_position_held" value="<?php echo  esc_attr( $meta_value ); ?>"
        placeholder="<?php esc_attr_e( 'Example: Staff', 'htsa-plugin' ); ?>" class="widefat" required />
</p>
