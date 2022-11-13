<?php
/**
 * $post_id         - The current post ID. Passed to the view by default
 * $meta_key        - The meta key. Passed to the view by default
 * $meta_value      - The meta value. Passed to the view by default
 */

printf(
    '<img src="%s" alt="" />',
    ( $attachment_id = $meta_value ) ? wp_get_attachment_image_url( $attachment_id, 'htsa-small' ) : WTS_THEME_URI . 'assets/images/man-76x76.png'
);

?>
