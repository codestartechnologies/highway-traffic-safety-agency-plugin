<?php
/**
 * $meta_key    - The meta key. Passed to the view by default
 * $meta_value  - The meta value. Passed to the view by default
 * $post        - The post object. Passed to the view by default
 */

$cars = $meta_value['cars'] ?? null;
$bus_shuttle = $meta_value['bus_shuttle'] ?? null;
$mini_bus = $meta_value['mini_bus'] ?? null;
$luxury_bus = $meta_value['luxury_bus'] ?? null;
$trailer = $meta_value['trailer'] ?? null;
$lorry = $meta_value['lorry'] ?? null;
$tricycle = $meta_value['tricycle'] ?? null;
$motorcycle = $meta_value['motorcycle'] ?? null;

?>

<p>
    <label for="htsa_penalty_vehicle_categories_car"> <?php esc_html_e( 'Cars', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[cars]" id="htsa_penalty_vehicle_categories_car" class="widefat"
        value="<?php echo esc_attr( $cars ); ?>" />
</p>

<p>
    <label for="htsa_penalty_vehicle_categories_bus"> <?php esc_html_e( 'Bus/Shuttle', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[bus_shuttle]" id="htsa_penalty_vehicle_categories_bus" class="widefat"
        value="<?php echo esc_attr( $bus_shuttle ); ?>" />
</p>

<p>
    <label for="htsa_penalty_vehicle_categories_mini_bus"> <?php esc_html_e( 'Mini Bus', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[mini_bus]" id="htsa_penalty_vehicle_categories_mini_bus" class="widefat"
        value="<?php echo esc_attr( $mini_bus ); ?>" />
</p>

<p>
    <label for="htsa_penalty_vehicle_categories_luxury_bus"> <?php esc_html_e( 'Luxury Bus', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[luxury_bus]" id="htsa_penalty_vehicle_categories_luxury_bus" class="widefat"
        value="<?php echo esc_attr( $luxury_bus ); ?>" />
</p>

<p>
    <label for="htsa_penalty_vehicle_categories_trailer"> <?php esc_html_e( 'Trailer', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[trailer]" id="htsa_penalty_vehicle_categories_trailer" class="widefat"
        value="<?php echo esc_attr( $trailer ); ?>" />
</p>

<p>
    <label for="htsa_penalty_vehicle_categories_lorry"> <?php esc_html_e( 'Lorry', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[lorry]" id="htsa_penalty_vehicle_categories_lorry" class="widefat"
        value="<?php echo esc_attr( $lorry ); ?>" />
</p>

<p>
    <label for="htsa_penalty_vehicle_categories_tricycle"> <?php esc_html_e( 'Tricycle (Keke Napepe)', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[tricycle]" id="htsa_penalty_vehicle_categories_tricycle" class="widefat"
        value="<?php echo esc_attr( $tricycle ); ?>" />
</p>

<p>
    <label for="htsa_penalty_vehicle_categories_motorcycle"> <?php esc_html_e( 'Motorcycle', 'htsa-plugin' ); ?></label><br /><br />
    <input type="number" min="1" name="<?php echo $meta_key; ?>[motorcycle]" id="htsa_penalty_vehicle_categories_motorcycle" class="widefat"
        value="<?php echo esc_attr( $motorcycle ); ?>" />
</p>
