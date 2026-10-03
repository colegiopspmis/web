<?php
/**
 * archive.php — Archivo de entradas / Categorías / Tags
 *
 * @package cspm-institucional
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="contenido-principal" class="cspm-main" role="main">
    <div class="cspm-container">

        <header class="cspm-section-header">
            <div>
                <h1 class="cspm-section-title">
                    <?php the_archive_title(); ?>
                </h1>
                <?php the_archive_description( '<p class="cspm-section-subtitle">', '</p>' ); ?>
            </div>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="cspm-posts-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content', 'post' ); ?>
                <?php endwhile; ?>
            </div>
            <nav class="cspm-pagination" aria-label="<?php esc_attr_e( 'Paginación', 'cspm-institucional' ); ?>">
                <?php the_posts_pagination( [
                    'mid_size'  => 2,
                    'prev_text' => '← ' . __( 'Anterior', 'cspm-institucional' ),
                    'next_text' => __( 'Siguiente', 'cspm-institucional' ) . ' →',
                ] ); ?>
            </nav>
        <?php else : ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
