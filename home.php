<?php
/** Índice editorial configurado en Ajustes > Lectura. */
defined( 'ABSPATH' ) || exit;
get_header(); ?>
<main id="contenido-principal" class="cspm-main"><div class="cspm-container">
<header class="cspm-section-header"><h1><?php esc_html_e( 'Novedades', 'cspm-institucional' ); ?></h1></header>
<?php if ( have_posts() ) : ?><div class="cspm-posts-grid">
<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content', 'post' ); endwhile; ?>
</div><?php the_posts_pagination(); else : get_template_part( 'template-parts/content', 'none' ); endif; ?>
</div></main><?php get_footer(); ?>
