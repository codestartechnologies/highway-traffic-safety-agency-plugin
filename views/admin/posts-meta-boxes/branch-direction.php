<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

?>

<p>
    <textarea name="<?php echo $meta_key; ?>" id="htsa_branch_direction" class="widefat textarea htsa-textarea" rows="5"
        ><?php echo esc_html( $meta_value ); ?></textarea>
</p>
