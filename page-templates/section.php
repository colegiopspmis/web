<?php
/**
 * Template Name: Sección institucional
 * Template Post Type: page
 * Introducción editable y accesos a páginas hijas publicadas.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="contenido-principal" class="cspm-main">
<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class( 'cspm-container' ); ?>>
    <header class="cspm-section-header"><h1><?php the_title(); ?></h1></header>
    <div class="entry-content"><?php the_content(); ?></div>
    <?php
    $children = get_pages( [
        'parent' => get_the_ID(), 'post_status' => 'publish',
        'sort_column' => 'menu_order,post_title',
    ] );
    if ( $children ) : ?>
        <div class="cspm-resource-grid">
        <?php foreach ( $children as $child ) : ?>
            <section>
                <h2><a href="<?php echo esc_url( get_permalink( $child ) ); ?>"><?php echo esc_html( get_the_title( $child ) ); ?></a></h2>
                <?php if ( $child->post_excerpt ) : ?>
                    <p><?php echo esc_html( wp_strip_all_tags( $child->post_excerpt ) ); ?></p>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
