<?php
/**
 * $post_id         - The current post ID. Passed to the view by default
 * $meta_key        - The meta key. Passed to the view by default
 * $meta_value      - The meta value. Passed to the view by default
 */

echo ( $meta_value ) ? sprintf( '<span style="text-transform: capitalize;font-size: 20px;">%s</span>', $meta_value ) : null;

?>
