<?php
/**
 * template-parts/content-post.php — Parcial de tarjeta de entrada
 *
 * Utilizado en index.php y archive.php para mostrar cada entrada.
 * En front-page.php se usa una versión inline para mejor control del grid.
 *
 * @package cspm-institucional
 */

defined( 'ABSPATH' ) || exit;
?>

<article
    id="post-<?php the_ID(); ?>"
    <?php post_class( 'cspm-card' ); ?>
    aria-label="<?php the_title_attribute(); ?>"
>
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="cspm-card__image-wrap" tabindex="-1" aria-hidden="true">
            <?php the_post_thumbnail( 'cspm-card', [
                'class'   => 'cspm-card__image',
                'loading' => 'lazy',
                'decoding'=> 'async',
                'alt'     => get_the_title(),
            ] ); ?>
        </a>
    <?php endif; ?>

    <div class="cspm-card__body">
        <div class="cspm-card__meta">
            <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>" class="cspm-card__date">
                <?php echo esc_html( get_the_date() ); ?>
            </time>
            <?php
            $categories = get_the_category();
            if ( $categories ) :
                $cat = $categories[0];
            ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="cspm-card__cat" rel="category tag">
                    <?php echo esc_html( $cat->name ); ?>
                </a>
            <?php endif; ?>
        </div>

        <h2 class="cspm-card__title">
            <a href="<?php the_permalink(); ?>" class="cspm-card__title-link">
                <?php the_title(); ?>
            </a>
        </h2>

        <p class="cspm-card__excerpt">
            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '…' ) ); ?>
        </p>

        <a href="<?php the_permalink(); ?>" class="cspm-card__read-more">
            <?php esc_html_e( 'Leer más', 'cspm-institucional' ); ?>
            <svg aria-hidden="true" focusable="false" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</article>
