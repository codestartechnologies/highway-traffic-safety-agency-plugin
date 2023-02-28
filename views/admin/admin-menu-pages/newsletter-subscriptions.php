<?php
/**
 * $newsletters_table     - Passed to the view by \HTSA_Plugin\WPS_Plugin\App\Admin\Menus\NewsletterSubscriptions::class.
 */

?>

<div class="wrap">

    <h2>
        <?php esc_html_e( 'Newsletter Subscriptions', 'htsa-plugin' ); ?>
        <a href="#" class="add-new-h2" style="display: none;"> <?php esc_html_e( 'Add New', 'htsa-plugin' ); ?> </a>
    </h2>

    <?php $newsletters_table->display(); ?>

</div>
