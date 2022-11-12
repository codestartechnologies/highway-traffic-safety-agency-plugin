<?php
/**
 * $post_id         - The current post ID. Passed to the view by default
 * $meta_key        - The meta key. Passed to the view by default
 * $meta_value      - The meta value. Passed to the view by default
 */

echo ( $meta_value )
    ? sprintf( '<a style="text-transform: uppercase;">%s</a>', $meta_value )
    : '<b>----</b>';

?>
