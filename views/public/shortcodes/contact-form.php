<form action="" method="post" class="ui form" data-htsa-id="contactForm">
    <div class="required field">
        <label for="htsaContactFormName"> <?php esc_html_e( 'Name', 'htsa-plugin' ); ?> </label>
        <input type="text" name="name" id="htsaContactFormName" class="border-secondary rounded-4" />
    </div>
    <div class="required field">
        <label for="htsaContactFormEmail"> <?php esc_html_e( 'Email', 'htsa-plugin' ); ?> </label>
        <input type="text" name="email" id="htsaContactFormEmail" class="border-secondary rounded-4" />
    </div>
    <div class="required field">
        <label for="htsaContactFormMessage"> <?php esc_html_e( 'Message', 'htsa-plugin' ); ?> </label>
        <textarea name="message" id="htsaContactFormMessage" class="border-secondary rounded-5"></textarea>
    </div>
    <button type="submit" class="ui black button"> <?php esc_html_e( 'Submit', 'htsa-plugin' ); ?> </button>
    <button type="button" class="ui black labeled icon button" style="display: none;">
        <i class="loading spinner icon"></i> <?php esc_html_e( 'Loading', 'htsa-plugin' ) ?>
    </button>
    <div class="ui error message"></div>
</form>
