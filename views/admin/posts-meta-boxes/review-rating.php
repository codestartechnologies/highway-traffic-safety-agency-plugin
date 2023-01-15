<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

?>

<p>
    <select name="<?php echo $meta_key; ?>" id="htsa_review_rating" class="widefat" required>
        <option value="5" <?php selected( esc_attr( $meta_value ), '5' ); ?>> 5 </option>
        <option value="4" <?php selected( esc_attr( $meta_value ), '4' ); ?>> 4 </option>
        <option value="3" <?php selected( esc_attr( $meta_value ), '3' ); ?>> 3 </option>
        <option value="2" <?php selected( esc_attr( $meta_value ), '2' ); ?>> 2 </option>
        <option value="1" <?php selected( esc_attr( $meta_value ), '1' ); ?>> 1 </option>
    </select>
</p>
