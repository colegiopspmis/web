<?php
/**
 * index.php — Plantilla de respaldo obligatoria de WordPress.
 *
 * WordPress redirige aquí si no existe ninguna otra plantilla más específica
 * en la jerarquía. En este tema el flujo principal es:
 *   - Portada   → front-page.php
 *   - Entradas  → single.php
 *   - Archivos  → archive.php
 *   - Páginas   → page.php
 *
 * @package cspm-institucional
 */

get_header();
?>

<main id="contenido-principal" class="cspm-main" role="main">
    <div class="cspm-container">

        <?php if ( have_posts() ) : ?>

            <header class="cspm-archive-header">
                <h1 class="cspm-archive-title"><?php echo esc_html( is_search() ? ( get_search_query() ? sprintf( __( 'Resultados para: %s', 'cspm-institucional' ), get_search_query() ) : __( 'Novedades', 'cspm-institucional' ) ) : __( 'Publicaciones', 'cspm-institucional' ) ); ?></h1>
                <?php the_archive_description( '<p class="cspm-archive-desc">', '</p>' ); ?>
            </header>

            <div class="cspm-posts-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content', 'post' ); ?>
                <?php endwhile; ?>
            </div>

            <?php the_posts_navigation(); ?>

        <?php else : ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        <?php endif; ?>

    </div><!-- .cspm-container -->
</main>

<?php
get_footer();
