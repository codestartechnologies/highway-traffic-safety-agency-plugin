<?php get_header(); ?>

<div class="ui hidden section divider"></div>

<section>

    <div class="container">

        <h3 class="ui horizontal section divider"> <?php esc_html_e( 'Available Shortcodes', 'htsa-plugin' ); ?> </h3>

        <h4> <?php esc_html_e( 'Contact Form Shortcode', 'htsa-plugin' ); ?> </h4>

        <div class="mb-5">
            <?php echo do_shortcode( '[htsa_contact_form]' ); ?>
        </div>

        <h4> <?php esc_html_e( 'Newsletter Form Shortcode', 'htsa-plugin' ); ?> </h4>

        <div class="mb-5">
            <?php echo do_shortcode( '[htsa_newsletter_form]' ); ?>
        </div>

    </div>

</section>

<div class="ui hidden section divider"></div>

<?php get_footer(); ?>