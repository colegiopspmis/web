<?php
defined('ABSPATH') || exit;
// ── Últimas novedades (WP_Query nativa — sin plugin)
$args_novedades = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
    'ignore_sticky_posts' => true,
];
$query_novedades = new WP_Query( $args_novedades );

?>
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
                    href="<?php echo esc_url( cspm_news_url() ); ?>"
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
