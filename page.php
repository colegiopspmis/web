<?php
/** Página editable mediante el contenido normal de WordPress. */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="contenido-principal" class="cspm-main cspm-page" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article
        id="page-<?php the_ID(); ?>"
        <?php post_class( 'cspm-page-article' ); ?>
    >
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="cspm-page-hero">
                <?php
                the_post_thumbnail( 'cspm-hero', [
                    'class'   => 'cspm-page-hero__img',
                    'loading' => 'eager',
                    'fetchpriority' => 'high',
                    'alt'     => get_the_title(),
                ] );
                ?>
                <div class="cspm-page-hero__overlay" aria-hidden="true"></div>
                <div class="cspm-container">
                    <h1 class="cspm-page-hero__title"><?php the_title(); ?></h1>
                </div>
            </div>
        <?php else : ?>
            <header class="cspm-page-header cspm-container">
                <h1 class="cspm-page-title"><?php the_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="cspm-container cspm-page-content entry-content">
            <?php the_content(); ?>
        </div>

    </article>

    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
