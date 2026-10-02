<?php
/** Pie institucional y áreas de navegación. */
?>

<footer
    id="cspm-footer"
    class="cspm-site-footer"
    role="contentinfo"
    aria-label="<?php esc_attr_e( 'Pie de página', 'cspm-institucional' ); ?>"
>
    <div class="cspm-footer-main cspm-container">

        <!-- Columna 1: Identidad institucional -->
        <div class="cspm-footer-col cspm-footer-col--brand">
            <a
                href="<?php echo esc_url( home_url( '/' ) ); ?>"
                class="cspm-footer-logo"
                aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                rel="home"
            >
                <?php
                $footer_logo_id = (int) get_theme_mod( 'cspm_footer_logo', 0 );
                if ( $footer_logo_id && wp_get_attachment_image_url( $footer_logo_id, 'full' ) ) {
                    echo wp_get_attachment_image( $footer_logo_id, 'full', false, [
                        'class' => 'cspm-footer-logo__img', 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async',
                    ] );
                } else {
                    ?>
                    <img src="<?php echo cspm_asset_url( 'images/logo-blanco.png' ); ?>" alt="" class="cspm-footer-logo__img" width="720" height="445" loading="lazy" decoding="async">
                    <?php
                }
                ?>
            </a>
            <p class="cspm-footer-tagline">
                <?php esc_html_e( 'Formación, ética y excelencia en la práctica psicopedagógica.', 'cspm-institucional' ); ?>
            </p>

            <!-- Redes sociales (configurar URLs desde Customizer) -->
            <nav
                class="cspm-footer-social"
                aria-label="<?php esc_attr_e( 'Redes sociales', 'cspm-institucional' ); ?>"
            >
                <?php
                $facebook_url = get_theme_mod( 'cspm_social_facebook', '' );
                $instagram_url = get_theme_mod( 'cspm_social_instagram', '' );
                $youtube_channel = get_theme_mod( 'cspm_social_youtube', '' );
                ?>

                <?php if ( $facebook_url ) : ?>
                <a
                    href="<?php echo esc_url( $facebook_url ); ?>"
                    class="cspm-social-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php esc_attr_e( 'Facebook del Colegio', 'cspm-institucional' ); ?>"
                >
                    <svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <?php endif; ?>

                <?php if ( $instagram_url ) : ?>
                <a
                    href="<?php echo esc_url( $instagram_url ); ?>"
                    class="cspm-social-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php esc_attr_e( 'Instagram del Colegio', 'cspm-institucional' ); ?>"
                >
                    <svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                <?php endif; ?>

                <?php if ( $youtube_channel ) : ?>
                <a
                    href="<?php echo esc_url( $youtube_channel ); ?>"
                    class="cspm-social-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php esc_attr_e( 'YouTube del Colegio', 'cspm-institucional' ); ?>"
                >
                    <svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon fill="#fff" points="9.75,15.02 15.5,12 9.75,8.98 9.75,15.02"/></svg>
                </a>
                <?php endif; ?>

            </nav>
        </div>

        <!-- Columna 2: Navegación rápida -->
        <div class="cspm-footer-col cspm-footer-col--nav">
            <h3 class="cspm-footer-col__title">
                <?php esc_html_e( 'Navegación', 'cspm-institucional' ); ?>
            </h3>
            <?php
            wp_nav_menu( [
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'cspm-footer-nav',
                'depth'          => 1,
                'fallback_cb'    => false,
                'items_wrap'     => '<ul class="%2$s" role="list">%3$s</ul>',
            ] );
            ?>
        </div>

        <!-- Columna 3: Datos de contacto -->
        <div class="cspm-footer-col cspm-footer-col--contact">
            <h3 class="cspm-footer-col__title">
                <?php esc_html_e( 'Contacto', 'cspm-institucional' ); ?>
            </h3>

            <address class="cspm-footer-address">
                <ul class="cspm-footer-contact-list" role="list">
                    <li class="cspm-footer-contact-item">
                        <svg aria-hidden="true" focusable="false" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Rivadavia 1436, Posadas, Misiones</span>
                    </li>
                    <li class="cspm-footer-contact-item">
                        <svg aria-hidden="true" focusable="false" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a
                            href="mailto:colegiopspmisiones@gmail.com"
                            class="cspm-footer-contact-link"
                        >
                            colegiopspmisiones@gmail.com
                        </a>
                    </li>
                </ul>
            </address>

            <a
                href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"
                class="cspm-btn cspm-btn--sm cspm-btn--outline-light"
            >
                <?php esc_html_e( 'Enviar mensaje', 'cspm-institucional' ); ?>
            </a>
        </div>

        <!-- Columna 4: Widget área (configuración desde admin) -->
        <div class="cspm-footer-col cspm-footer-col--widgets">

        </div>

    </div><!-- .cspm-footer-main -->

    <!-- Barra inferior de copyright -->
    <div class="cspm-footer-bar">
        <div class="cspm-container cspm-footer-bar__inner">
            <p class="cspm-footer-bar__copy">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <?php esc_html_e( 'Colegio de Psicopedagogos de Misiones.', 'cspm-institucional' ); ?>
                <?php esc_html_e( 'Todos los derechos reservados.', 'cspm-institucional' ); ?>
            </p>
            <p class="cspm-footer-bar__legal">
                <a href="<?php echo esc_url( home_url( '/politica-de-privacidad/' ) ); ?>">
                    <?php esc_html_e( 'Política de Privacidad', 'cspm-institucional' ); ?>
                </a>
                <span aria-hidden="true"> · </span>
                <a href="<?php echo esc_url( home_url( '/aviso-legal/' ) ); ?>">
                    <?php esc_html_e( 'Aviso Legal', 'cspm-institucional' ); ?>
                </a>
            </p>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
