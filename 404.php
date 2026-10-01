<?php
defined( 'ABSPATH' ) || exit;
get_header(); ?>
<main id="contenido-principal" class="cspm-main"><div class="cspm-container">
<h1><?php esc_html_e( 'No encontramos esta página', 'cspm-institucional' ); ?></h1>
<p><?php esc_html_e( 'Podés buscar el contenido o volver al inicio.', 'cspm-institucional' ); ?></p>
<?php get_search_form(); ?><p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Volver al inicio', 'cspm-institucional' ); ?></a></p>
</div></main><?php get_footer(); ?>
