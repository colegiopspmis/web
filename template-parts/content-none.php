<?php
/**
 * template-parts/content-none.php — Estado vacío
 *
 * Se muestra cuando no hay entradas que mostrar.
 *
 * @package cspm-institucional
 */
?>
<section class="cspm-no-results cspm-container" aria-label="<?php esc_attr_e( 'Sin resultados', 'cspm-institucional' ); ?>">
    <h2><?php esc_html_e( 'No se encontraron resultados', 'cspm-institucional' ); ?></h2>
    <p><?php esc_html_e( 'Lo sentimos, no hay contenido que coincida con tu búsqueda. Probá con otro término.', 'cspm-institucional' ); ?></p>
    <?php get_search_form(); ?>
</section>
