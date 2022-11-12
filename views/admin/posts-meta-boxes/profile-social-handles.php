<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

$facebook = $meta_value['facebook'] ?? null;
$twitter = $meta_value['twitter'] ?? null;
$instagram = $meta_value['instagram'] ?? null;
$linkedin = $meta_value['linkedin'] ?? null;

?>

<p>
    <label for="profile_social_handle_fb"> <?php esc_html_e( 'Facebook:', 'htsa-plugin' ); ?></label><br /><br />
    <input type="text" name="<?php echo $meta_key; ?>[facebook]" id="profile_social_handle_fb" class="widefat"
        value="<?php echo esc_attr( $facebook ); ?>" required />
</p>

<p>
    <label for="profile_social_handle_tw"> <?php esc_html_e( 'Twitter:', 'htsa-plugin' ); ?></label><br /><br />
    <input type="text" name="<?php echo $meta_key; ?>[twitter]" id="profile_social_handle_tw" class="widefat"
        value="<?php echo esc_attr( $twitter ); ?>" required />
</p>

<p>
    <label for="profile_social_handle_ig"> <?php esc_html_e( 'Instagram:', 'htsa-plugin' ); ?></label><br /><br />
    <input type="text" name="<?php echo $meta_key; ?>[instagram]" id="profile_social_handle_ig" class="widefat"
        value="<?php echo esc_attr( $instagram ); ?>" required />
</p>

<p>
    <label for="profile_social_handle_li"> <?php esc_html_e( 'LinkedIn:', 'htsa-plugin' ); ?></label><br /><br />
    <input type="text" name="<?php echo $meta_key; ?>[linkedin]" id="profile_social_handle_li" class="widefat"
        value="<?php echo esc_attr( $linkedin ); ?>" required />
</p>
