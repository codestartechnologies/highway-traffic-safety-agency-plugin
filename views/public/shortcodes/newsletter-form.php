<!-- Newsletter Subscription Form -->
<div class="col-md-4 order-first">
    <h5 class="fw-normal text-capitalize htsa-text-yellow mb-2"> <?php esc_html_e( 'Newsletter form', 'htsa-plugin' ); ?> </h5>
    <form action="#" class="ui inverted form" data-htsa-id="newsletterForm">
        <div class="required field">
            <label for=""> <?php esc_html_e( 'Fullname', 'htsa-plugin' ); ?> </label>
            <input type="text" name="name" id="htsaNewsletterFormName" class="rounded-0" />
        </div>
        <div class="required field">
            <label for=""> <?php esc_html_e( 'Email Address', 'htsa-plugin' ); ?> </label>
            <input type="email" name="email" id="htsaNewsletterFormEmail" class="rounded-0" />
        </div>
        <button class="ui button bg-warning text-dark rounded-0" type="submit">
            <?php esc_html_e( 'Subscribe me to newsletters', 'htsa-plugin' ); ?>
        </button>
    </form>
</div>
<!-- End Newsletter Subscription Form -->