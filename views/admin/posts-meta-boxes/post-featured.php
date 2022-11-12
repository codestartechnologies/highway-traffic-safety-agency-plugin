<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

?>

<p>
    <input type="checkbox" name="<?php echo $meta_key; ?>" id="htsa_post_featured" value="1" <?php checked( $meta_value ); ?> required />
    <label for="htsa_post_featured"> <?php esc_html_e( 'Mark as featured', 'htsa-plugin' ); ?></label>
</p>
