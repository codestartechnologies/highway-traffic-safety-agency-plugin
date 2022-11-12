<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

?>

<p>
    <input type="text" name="<?php echo $meta_key; ?>" id="htsa_branch_location" class="widefat" value="<?php echo esc_attr( $meta_value ); ?>" required />
</p>
