<?php
/** Entrada individual. Los shortcodes heredados requieren su plugin legítimo. */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="contenido-principal" class="cspm-main cspm-single" role="main">
    <div class="cspm-container cspm-single__wrap">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article
            id="post-<?php the_ID(); ?>"
            <?php post_class( 'cspm-single-post' ); ?>
            aria-label="<?php the_title_attribute(); ?>"
        >
            <!-- Breadcrumb mínimo -->
            <nav class="cspm-breadcrumb" aria-label="<?php esc_attr_e( 'Ruta de navegación', 'cspm-institucional' ); ?>">
                <ol class="cspm-breadcrumb__list" role="list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'cspm-institucional' ); ?></a></li>
                    <li aria-hidden="true" class="cspm-breadcrumb__sep">/</li>
                    <li>
                        <a href="<?php echo esc_url( cspm_news_url() ); ?>">
                            <?php esc_html_e( 'Novedades', 'cspm-institucional' ); ?>
                        </a>
                    </li>
                    <li aria-hidden="true" class="cspm-breadcrumb__sep">/</li>
                    <li aria-current="page"><?php the_title(); ?></li>
                </ol>
            </nav>

            <header class="cspm-post-header">
                <?php
                $categories = get_the_category();
                if ( $categories ) :
                    $cat = $categories[0];
                ?>
                    <a
                        href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                        class="cspm-card__cat cspm-post-cat"
                        rel="category tag"
                    >
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                <?php endif; ?>

                <h1 class="cspm-post-title"><?php the_title(); ?></h1>

                <div class="cspm-post-meta">
                    <time
                        datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"
                        class="cspm-post-meta__date"
                    >
                        <?php echo esc_html( get_the_date() ); ?>
                    </time>
                    <span class="cspm-post-meta__author">
                        <?php esc_html_e( 'Por', 'cspm-institucional' ); ?>
                        <?php the_author(); ?>
                    </span>
                    <?php
                    $reading_time = max( 1, (int) ( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
                    ?>
                    <span class="cspm-post-meta__read">
                        <?php printf(
                            _n( '%d min de lectura', '%d min de lectura', $reading_time, 'cspm-institucional' ),
                            $reading_time
                        ); ?>
                    </span>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <figure class="cspm-post-thumbnail">
                    <?php
                    the_post_thumbnail( 'cspm-hero', [
                        'class'        => 'cspm-post-thumbnail__img',
                        'loading'      => 'eager',
                        'fetchpriority'=> 'high',
                        'decoding'     => 'async',
                        'alt'          => get_the_title(),
                    ] );
                    ?>
                    <?php if ( get_the_post_thumbnail_caption() ) : ?>
                        <figcaption class="cspm-post-thumbnail__cap">
                            <?php echo wp_kses_post( get_the_post_thumbnail_caption() ); ?>
                        </figcaption>
                    <?php endif; ?>
                </figure>
            <?php endif; ?>

            <!-- El contenido puede incluir shortcodes de Divi heredados -->
            <div class="cspm-post-content entry-content">
                <?php the_content(); ?>
            </div>

            <?php
            // Paginación de páginas internas del post (<!--nextpage-->)
            wp_link_pages( [
                'before' => '<nav class="cspm-post-pages"><span>' . __( 'Páginas:', 'cspm-institucional' ) . '</span>',
                'after'  => '</nav>',
            ] );
            ?>

            <footer class="cspm-post-footer">
                <!-- Tags -->
                <?php the_tags( '<div class="cspm-post-tags"><span>' . __( 'Etiquetas: ', 'cspm-institucional' ) . '</span>', ', ', '</div>' ); ?>

                <!-- Navegación anterior / siguiente -->
                <nav class="cspm-post-nav" aria-label="<?php esc_attr_e( 'Entradas relacionadas', 'cspm-institucional' ); ?>">
                    <?php
                    the_post_navigation( [
                        'prev_text' => '← %title',
                        'next_text' => '%title →',
                        'screen_reader_text' => __( 'Navegación de entradas', 'cspm-institucional' ),
                    ] );
                    ?>
                </nav>
            </footer>

        </article>

        <?php
        // Comentarios (si están habilitados)
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
        ?>

        <?php endwhile; endif; ?>

    </div><!-- .cspm-single__wrap -->
</main>

<?php get_footer(); ?>
