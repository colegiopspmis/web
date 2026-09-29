<?php
/**
 * front-page.php — Portada del Colegio de Psicopedagogos de Misiones
 *
 * Correcciones de auditoría aplicadas:
 *  ✔ H1 con el nombre de la institución (antes ausente en portada)
 *  ✔ Jerarquía de encabezados correcta (H1 → H2 → H3)
 *  ✔ Enlace YouTube corregido (función cspm_youtube_url)
 *  ✔ HTML5 semántico: <header>, <nav>, <main>, <section>, <article>, <aside>, <footer>
 *  ✔ Aria-labels en secciones para accesibilidad
 *  ✔ Datos institucionales estáticos: Rivadavia 1436, Posadas / colegiopspmisiones@gmail.com
 *  ✔ Integración Tidio (psicopebot-simple) mediante snippet en footer
 *
 * @package cspm-institucional
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

// ── Últimas novedades (WP_Query nativa — sin plugin)
$args_novedades = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
];
$query_novedades = new WP_Query( $args_novedades );

// ── ID del video YouTube institucional (configurable desde Customizer/ACF)
$youtube_video_id = get_theme_mod( 'cspm_youtube_video_id', '' );

?>

<main id="contenido-principal" class="cspm-main cspm-home" role="main">

    <!-- ================================================================ -->
    <!-- SECCIÓN 1 — HERO / PORTADA                                      -->
    <!-- ================================================================ -->
    <section
        class="cspm-hero"
        aria-label="<?php esc_attr_e( 'Portada institucional', 'cspm-institucional' ); ?>"
    >
        <div class="cspm-hero__overlay" aria-hidden="true"></div>

        <div class="cspm-hero__content cspm-container">
            <!--
                CORRECCIÓN AUDITORÍA:
                El H1 principal de la portada es el nombre de la institución.
                Anteriormente "Materiales" y "Biblioteca" llevaban el H1.
            -->
            <h1 class="cspm-hero__title">
                <span class="cspm-hero__title-line1">
                    <?php esc_html_e( 'Colegio de', 'cspm-institucional' ); ?>
                </span>
                <span class="cspm-hero__title-line2">
                    <?php esc_html_e( 'Psicopedagogos', 'cspm-institucional' ); ?>
                </span>
                <span class="cspm-hero__title-line3">
                    <?php esc_html_e( 'de Misiones', 'cspm-institucional' ); ?>
                </span>
            </h1>

            <p class="cspm-hero__tagline">
                <?php esc_html_e(
                    'Formación continua, matrícula profesional y comunidad psicopedagógica en la provincia de Misiones.',
                    'cspm-institucional'
                ); ?>
            </p>

            <div class="cspm-hero__actions" role="group" aria-label="<?php esc_attr_e( 'Acciones principales', 'cspm-institucional' ); ?>">
                <a
                    href="<?php echo esc_url( home_url( '/tramites-2/' ) ); ?>"
                    class="cspm-btn cspm-btn--primary"
                >
                    <?php esc_html_e( 'Trámites y Matrícula', 'cspm-institucional' ); ?>
                    <svg aria-hidden="true" focusable="false" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>

                <a
                    href="<?php echo esc_url( home_url( '/el-colegio/' ) ); ?>"
                    class="cspm-btn cspm-btn--outline"
                >
                    <?php esc_html_e( 'Conocer el Colegio', 'cspm-institucional' ); ?>
                </a>
            </div>
        </div>

        <div class="cspm-hero__scroll-indicator" aria-hidden="true">
            <span class="cspm-scroll-line"></span>
        </div>
    </section>


    <!-- ================================================================ -->
    <!-- SECCIÓN 2 — ACCESOS RÁPIDOS (Quick Links)                       -->
    <!-- ================================================================ -->
    <section
        class="cspm-quick-links"
        aria-label="<?php esc_attr_e( 'Accesos rápidos', 'cspm-institucional' ); ?>"
    >
        <div class="cspm-container">
            <ul class="cspm-quick-links__grid" role="list">

                <li class="cspm-quick-link-card">
                    <a href="<?php echo esc_url( home_url( '/matriculados-2/' ) ); ?>" class="cspm-quick-link-card__link">
                        <div class="cspm-quick-link-card__icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <h2 class="cspm-quick-link-card__title">
                            <?php esc_html_e( 'Padrón de Matriculados', 'cspm-institucional' ); ?>
                        </h2>
                        <p class="cspm-quick-link-card__desc">
                            <?php esc_html_e( 'Consulta el listado actualizado de profesionales matriculados en la provincia.', 'cspm-institucional' ); ?>
                        </p>
                    </a>
                </li>

                <li class="cspm-quick-link-card">
                    <a href="<?php echo esc_url( home_url( '/tramites-2/' ) ); ?>" class="cspm-quick-link-card__link">
                        <div class="cspm-quick-link-card__icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        </div>
                        <h2 class="cspm-quick-link-card__title">
                            <?php esc_html_e( 'Trámites y Certificados', 'cspm-institucional' ); ?>
                        </h2>
                        <p class="cspm-quick-link-card__desc">
                            <?php esc_html_e( 'Solicita certificados de matrícula, habilitaciones y gestiona tus trámites en línea.', 'cspm-institucional' ); ?>
                        </p>
                    </a>
                </li>

                <li class="cspm-quick-link-card">
                    <a
                        href="https://autogestion.colegiopspmisiones.com.ar/"
                        class="cspm-quick-link-card__link"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <div class="cspm-quick-link-card__icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                        </div>
                        <h2 class="cspm-quick-link-card__title">
                            <?php esc_html_e( 'Autogestión en Línea', 'cspm-institucional' ); ?>
                        </h2>
                        <p class="cspm-quick-link-card__desc">
                            <?php esc_html_e( 'Portal exclusivo para profesionales matriculados. Accede a tu área personal.', 'cspm-institucional' ); ?>
                        </p>
                    </a>
                </li>

                <li class="cspm-quick-link-card">
                    <a
                        href="https://koha.colegiopspmisiones.com.ar/"
                        class="cspm-quick-link-card__link"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <div class="cspm-quick-link-card__icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <h2 class="cspm-quick-link-card__title">
                            <?php esc_html_e( 'Biblioteca Digital (Koha)', 'cspm-institucional' ); ?>
                        </h2>
                        <p class="cspm-quick-link-card__desc">
                            <?php esc_html_e( 'Accede al catálogo bibliográfico y recursos de la biblioteca institucional.', 'cspm-institucional' ); ?>
                        </p>
                    </a>
                </li>

            </ul>
        </div>
    </section>


    <!-- ================================================================ -->
    <!-- SECCIÓN 3 — NOVEDADES / ÚLTIMAS NOTICIAS                        -->
    <!-- ================================================================ -->
    <section
        class="cspm-novedades"
        aria-label="<?php esc_attr_e( 'Novedades institucionales', 'cspm-institucional' ); ?>"
    >
        <div class="cspm-container">

            <header class="cspm-section-header">
                <h2 class="cspm-section-title">
                    <?php esc_html_e( 'Novedades', 'cspm-institucional' ); ?>
                </h2>
                <p class="cspm-section-subtitle">
                    <?php esc_html_e( 'Actividades, comunicados y noticias del Colegio.', 'cspm-institucional' ); ?>
                </p>
                <a
                    href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
                    class="cspm-link-all"
                    aria-label="<?php esc_attr_e( 'Ver todas las novedades', 'cspm-institucional' ); ?>"
                >
                    <?php esc_html_e( 'Ver todas', 'cspm-institucional' ); ?> →
                </a>
            </header>

            <?php if ( $query_novedades->have_posts() ) : ?>

                <div class="cspm-novedades__grid">

                    <?php
                    $is_first = true;
                    while ( $query_novedades->have_posts() ) :
                        $query_novedades->the_post();
                    ?>

                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class( 'cspm-card' . ( $is_first ? ' cspm-card--featured' : '' ) ); ?>
                            aria-label="<?php the_title_attribute(); ?>"
                        >
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="cspm-card__image-wrap"
                                    tabindex="-1"
                                    aria-hidden="true"
                                >
                                    <?php
                                    the_post_thumbnail(
                                        $is_first ? 'cspm-hero' : 'cspm-card',
                                        [
                                            'class'   => 'cspm-card__image',
                                            'loading' => $is_first ? 'eager' : 'lazy',
                                            'decoding'=> 'async',
                                            'alt'     => get_the_title(),
                                        ]
                                    );
                                    ?>
                                </a>
                            <?php endif; ?>

                            <div class="cspm-card__body">
                                <div class="cspm-card__meta">
                                    <time
                                        datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"
                                        class="cspm-card__date"
                                    >
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </time>
                                    <?php
                                    $categories = get_the_category();
                                    if ( $categories ) :
                                        $cat = $categories[0];
                                    ?>
                                        <a
                                            href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                                            class="cspm-card__cat"
                                            rel="category tag"
                                        >
                                            <?php echo esc_html( $cat->name ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <h3 class="cspm-card__title">
                                    <a href="<?php the_permalink(); ?>" class="cspm-card__title-link">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <?php if ( $is_first ) : ?>
                                    <p class="cspm-card__excerpt">
                                        <?php echo esc_html( wp_trim_words( get_the_excerpt(), 25, '…' ) ); ?>
                                    </p>
                                <?php endif; ?>

                                <a href="<?php the_permalink(); ?>" class="cspm-card__read-more">
                                    <?php esc_html_e( 'Leer más', 'cspm-institucional' ); ?>
                                    <svg aria-hidden="true" focusable="false" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </article>

                    <?php
                        $is_first = false;
                    endwhile;
                    wp_reset_postdata();
                    ?>

                </div><!-- .cspm-novedades__grid -->

            <?php else : ?>
                <p class="cspm-no-results">
                    <?php esc_html_e( 'No hay novedades disponibles en este momento.', 'cspm-institucional' ); ?>
                </p>
            <?php endif; ?>

        </div><!-- .cspm-container -->
    </section>


    <!-- ================================================================ -->
    <!-- SECCIÓN 4 — VIDEO INSTITUCIONAL (YouTube corregido)             -->
    <!-- ================================================================ -->
    <?php if ( ! empty( $youtube_video_id ) ) : ?>
    <section
        class="cspm-video"
        aria-label="<?php esc_attr_e( 'Video institucional', 'cspm-institucional' ); ?>"
    >
        <div class="cspm-container">
            <header class="cspm-section-header cspm-section-header--centered">
                <h2 class="cspm-section-title">
                    <?php esc_html_e( 'Conocé el Colegio', 'cspm-institucional' ); ?>
                </h2>
            </header>

            <div class="cspm-video__wrapper">
                <!--
                    CORRECCIÓN AUDITORÍA: Enlace YouTube roto (concatenado incorrectamente).
                    Se utiliza la función cspm_youtube_url() para generar la URL de forma segura.
                    El embed usa loading="lazy" y título accesible para iframes.
                -->
                <iframe
                    class="cspm-video__iframe"
                    src="<?php echo esc_url( 'https://www.youtube.com/embed/' . rawurlencode( $youtube_video_id ) . '?rel=0&modestbranding=1' ); ?>"
                    title="<?php esc_attr_e( 'Video institucional — Colegio de Psicopedagogos de Misiones', 'cspm-institucional' ); ?>"
                    loading="lazy"
                    allowfullscreen
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                ></iframe>
            </div>

            <p class="cspm-video__link-text">
                <?php esc_html_e( 'También podés ver el video en:', 'cspm-institucional' ); ?>
                <a
                    href="<?php echo cspm_youtube_url( $youtube_video_id ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="cspm-link"
                >
                    YouTube →
                </a>
            </p>
        </div>
    </section>
    <?php endif; ?>


    <!-- ================================================================ -->
    <!-- SECCIÓN 5 — DATOS DE CONTACTO / CTA INFERIOR                   -->
    <!-- ================================================================ -->
    <section
        class="cspm-contact-banner"
        aria-label="<?php esc_attr_e( 'Información de contacto', 'cspm-institucional' ); ?>"
    >
        <div class="cspm-container cspm-contact-banner__inner">

            <div class="cspm-contact-banner__text">
                <h2 class="cspm-contact-banner__title">
                    <?php esc_html_e( '¿Necesitás ayuda o información?', 'cspm-institucional' ); ?>
                </h2>
                <p class="cspm-contact-banner__subtitle">
                    <?php esc_html_e( 'Nuestro equipo está disponible para orientarte en cualquier trámite o consulta institucional.', 'cspm-institucional' ); ?>
                </p>
            </div>

            <address class="cspm-contact-banner__info">
                <ul class="cspm-contact-list" role="list">
                    <li class="cspm-contact-item">
                        <svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Rivadavia 1436, Posadas, Misiones</span>
                    </li>
                    <li class="cspm-contact-item">
                        <svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a
                            href="mailto:colegiopspmisiones@gmail.com"
                            class="cspm-contact-item__link"
                        >
                            colegiopspmisiones@gmail.com
                        </a>
                    </li>
                </ul>
            </address>

            <a
                href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"
                class="cspm-btn cspm-btn--primary"
            >
                <?php esc_html_e( 'Ir a Contacto', 'cspm-institucional' ); ?>
            </a>

        </div>
    </section>

</main><!-- #contenido-principal -->

<?php get_footer(); ?>
