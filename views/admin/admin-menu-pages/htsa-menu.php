<div class="wrap">

    <div class="d-flex htsa-panel-top">

        <div class="left">
            <h3> <?php echo HTSA_PLUGIN_NAME; ?> </h3>
            <h4> <?php esc_html_e( 'By Codestar Technologies', 'htsa-plugin' ); ?> </h4>
            <p>
                <?php
                    printf( __( '
                        WordPress plugin for developing websites relating to a highway/road traffic safety agency. It comes with custom post
                        types, taxonomies, shortcodes, email sending feature, and custom route endpoints. It can be used along side <a href="%1$s" target="_blank">%2$s</a>.
                        You can <a href="%3$s" target="_blank">get support</a> when you\'ve purchased an active support plan on our website.
                    ', 'htsa-plugin' ), HTSA_PLUGIN_RECOMMENDED_THEME_URL, HTSA_PLUGIN_RECOMMENDED_THEME_NAME, HTSA_PLUGIN_SUPPORT_URL );
                ?>
            </p>
        </div>

        <div class="right">
            <img src="<?php echo WPS_IMAGES_BASE_URL . 'banner.png'; ?>" alt="" />
        </div>

    </div>

    <div class="htsa-panel-content">

        <div class="d-flex">

            <div>
                <h4> <?php esc_html_e( 'Post Types', 'htsa-plugin' ); ?> </h4>

                <?php
                    printf( __(
                        '
                            <p>
                                This plugin registers <b>five (5)</b> custom post types. We recommend you have <b>%s</b>
                                WordPress theme installed and active, in order for all the features included in the post types to be visible.
                            </p>
                            <ul>
                                <li><b><a href="%s" target="_blank">Profiles</a></b> - This archive shows a list of profiles for all the officers employed by the agency. </li>
                                <li><b><a href="%s" target="_blank">Officers</a></b> - This archive is used for displaying a list of all the agency\'s principal officers and their contact information. </li>
                                <li><b><a href="%s" target="_blank">Branches</a></b> - This archive displays all the branches/head offices of the agency</li>
                                <li><b><a href="%s" target="_blank">Penalties</a></b> - This archive contains penalty tariffs from the agency. </li>
                                <li><b><a href="%s" target="_blank">Reviews</a></b> - This archive shows reviews for the agency from the public. Reviews do not have a dedicated archive page, they are only shown on the front/home page (when the theme is Highway Traffic Security Agency).</li>
                            </ul>
                        ',
                        'htsa-plugin'
                    ), HTSA_PLUGIN_RECOMMENDED_THEME_NAME, site_url( 'profiles' ), site_url( 'officers' ), site_url( 'branches' ), site_url( 'penalties' ), site_url() );
                ?>

            </div>

            <div>
                <h4> <?php esc_html_e( 'Shortcodes', 'htsa-plugin' ); ?> </h4>

                <?php
                    printf( __(
                        '
                            <p>
                                This plugin registers two shortcodes. We recommend you have <b>%s</b>
                                WordPress theme installed and active, in order for all the shortcodes to be styled properly.
                            </p>
                            <ul>
                                <li><b>Newsletter Form Shortcode <code>[htsa_newsletter_form]</code></b> - Adds a newsletter subscription form in the page. This shortcode is added by default in the footer section of the site.</li>
                                <li><b>Contact Form Shortcode <code>[htsa_contact_form]</code></b> - Adds a contact form in the page. This shortcode is added by default in the contact page. It can also be added anywhere in a page.</li>
                            </ul>
                        ',
                        'htsa-plugin'
                    ), HTSA_PLUGIN_RECOMMENDED_THEME_NAME );
                ?>

                <?php if ( wps_is_theme_active( HTSA_PLUGIN_RECOMMENDED_THEME_NAME ) ) : ?>
                    <a href="<?php echo site_url( 'htsa-shortcodes' ); ?>" target="_blank" class="link"> <?php esc_html_e( 'Preview available shortcodes', 'htsa-plugin' ); ?> </a>
                <?php endif; ?>
            </div>

            <div>
                <h4> <?php esc_html_e( 'Email Feature', 'htsa-plugin' ); ?> </h4>

                <?php
                    _e(
                        '
                            <p>
                                This plugin comes with email setting for sending emails via Simple Mail Transfer Protocol (SMTP).
                            </p>
                        ',
                        'htsa-plugin'
                    );
                ?>

                <a href="<?php echo admin_url( 'options-general.php?page=htsa-email-setting' ); ?>" class="link"> <?php esc_html_e( 'Go to email setting', 'htsa-plugin' ); ?> </a>
            </div>

        </div>

    </div>

</div>
