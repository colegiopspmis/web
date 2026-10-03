<?php
/**
 * Template Name: Documentación
 * Template Post Type: page
 * Listado de documentos institucionales descargables. Los datos están en inc/documents.php.
 * El texto escrito en el editor de la página se muestra como introducción.
 */
defined( 'ABSPATH' ) || exit;
get_header();
$cspm_groups = cspm_document_groups();
?>
<main id="contenido-principal" class="cspm-main cspm-docs" role="main">
<?php while ( have_posts() ) : the_post(); ?>
    <header class="cspm-doc-hero">
        <div class="cspm-container">
            <p class="cspm-eyebrow"><?php esc_html_e( 'Colegio de Psicopedagogos de Misiones', 'cspm-institucional' ); ?></p>
            <h1><?php the_title(); ?></h1>
            <div class="cspm-doc-hero__lead">
                <?php if ( '' !== trim( wp_strip_all_tags( get_the_content() ) ) ) : ?>
                    <?php the_content(); ?>
                <?php else : ?>
                    <p><?php esc_html_e( 'Normativa, reglamentos y modelos de uso profesional. Todos los documentos se pueden consultar y descargar en PDF.', 'cspm-institucional' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div class="cspm-container cspm-doc-body">
    <?php foreach ( $cspm_groups as $group ) : ?>
        <section class="cspm-doc-group" id="<?php echo esc_attr( $group['id'] ); ?>" aria-labelledby="<?php echo esc_attr( $group['id'] ); ?>-title">
            <?php
            $img = ( ! empty( $group['image']['file'] ) && is_readable( CSPM_DIR . '/assets/images/' . $group['image']['file'] ) ) ? $group['image'] : null;
            ?>
            <?php if ( $img ) : ?>
            <div class="cspm-doc-feature">
                <div class="cspm-doc-feature__text">
                    <h2 class="cspm-section-title" id="<?php echo esc_attr( $group['id'] ); ?>-title"><?php echo esc_html( $group['title'] ); ?></h2>
                    <?php if ( ! empty( $group['intro'] ) ) : ?>
                        <p class="cspm-doc-group__intro"><?php echo esc_html( $group['intro'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $group['quote'] ) ) : ?>
                        <p class="cspm-doc-quote"><?php echo esc_html( $group['quote'] ); ?></p>
                    <?php endif; ?>
                </div>
                <figure class="cspm-doc-feature__art">
                    <img src="<?php echo cspm_asset_url( 'images/' . $img['file'] ); ?>"
                         alt="<?php echo esc_attr( $img['alt'] ); ?>"
                         width="<?php echo (int) $img['width']; ?>" height="<?php echo (int) $img['height']; ?>"
                         loading="lazy" decoding="async">
                    <?php if ( ! empty( $img['caption'] ) ) : ?>
                        <figcaption><?php echo esc_html( $img['caption'] ); ?></figcaption>
                    <?php endif; ?>
                </figure>
            </div>
            <?php else : ?>
            <h2 class="cspm-section-title" id="<?php echo esc_attr( $group['id'] ); ?>-title"><?php echo esc_html( $group['title'] ); ?></h2>
            <?php if ( ! empty( $group['intro'] ) ) : ?>
                <p class="cspm-doc-group__intro"><?php echo esc_html( $group['intro'] ); ?></p>
            <?php endif; ?>
            <?php endif; ?>
            <div class="cspm-doc-grid">
            <?php foreach ( $group['items'] as $doc ) :
                $path   = CSPM_DIR . '/assets/documents/' . $doc['file'];
                $exists = is_readable( $path );
                ?>
                <article class="cspm-doc-card" id="<?php echo esc_attr( $doc['id'] ); ?>">
                    <svg class="cspm-doc-card__icon" aria-hidden="true" focusable="false" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="14" y2="17"/></svg>
                    <h3 class="cspm-doc-card__title"><?php echo esc_html( $doc['title'] ); ?></h3>
                    <p class="cspm-doc-card__desc"><?php echo esc_html( $doc['desc'] ); ?></p>
                    <?php if ( $exists ) : ?>
                        <a class="cspm-btn cspm-btn--primary cspm-doc-card__btn"
                           href="<?php echo cspm_asset_url( 'documents/' . $doc['file'] ); ?>"
                           target="_blank" rel="noopener"
                           aria-label="<?php echo esc_attr( sprintf( 'Descargar %s (PDF, %s)', $doc['title'], size_format( (int) filesize( $path ), 1 ) ) ); ?>">
                            <?php esc_html_e( 'Descargar PDF', 'cspm-institucional' ); ?>
                            <span class="cspm-doc-card__size"><?php echo esc_html( size_format( (int) filesize( $path ), 1 ) ); ?></span>
                        </a>
                    <?php else : ?>
                        <span class="cspm-doc-card__soon"><?php esc_html_e( 'Documento en preparación', 'cspm-institucional' ); ?></span>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
    </div>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
