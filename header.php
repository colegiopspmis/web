<?php
/**
 * header.php — Cabecera global del tema CSPM Institucional
 *
 * Incluye:
 *  - <!DOCTYPE html> y lang="es-AR"
 *  - wp_head() con preconnect de fuentes ya en functions.php
 *  - <header> semántico con logo, menú principal y botón móvil
 *  - Skip link de accesibilidad
 *
 * @package cspm-institucional
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#28b6bc">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip link: accesibilidad teclado/lectores de pantalla -->
<a class="cspm-skip-link screen-reader-text" href="#contenido-principal">
    <?php esc_html_e( 'Saltar al contenido principal', 'cspm-institucional' ); ?>
</a>

<header
    id="cspm-header"
    class="cspm-site-header"
    role="banner"
    aria-label="<?php esc_attr_e( 'Cabecera del sitio', 'cspm-institucional' ); ?>"
>
    <div class="cspm-header-inner cspm-container">

        <!-- Logo / Identidad -->
        <div class="cspm-site-branding">
            <a
                href="<?php echo esc_url( home_url( '/' ) ); ?>"
                class="cspm-logo-link"
                aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' — ' . __( 'Inicio', 'cspm-institucional' ) ); ?>"
                rel="home"
            >
                <?php
                $logo_id = get_theme_mod( 'custom_logo' );
                if ( $logo_id ) :
                    $logo_src = wp_get_attachment_image_url( $logo_id, 'full' );
                ?>
                    <img
                        src="<?php echo esc_url( $logo_src ); ?>"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                        class="cspm-logo-img"
                        width="200"
                        height="60"
                        loading="eager"
                        decoding="async"
                        fetchpriority="high"
                    >
                <?php else : ?>
                    <img src="<?php echo cspm_asset_url( 'images/logo-color.png' ); ?>" alt="Colegio de Psicopedagogos de Misiones" class="cspm-logo-img" width="1624" height="1004" decoding="async">
                <?php endif; ?>
            </a>
        </div>

        <!-- Navegación Principal -->
        <nav
            id="cspm-nav-primary"
            class="cspm-nav-primary"
            aria-label="<?php esc_attr_e( 'Menú principal', 'cspm-institucional' ); ?>"
        >
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'cspm-nav__list',
                'fallback_cb'    => 'cspm_fallback_nav',
                'depth'          => 3,
                'items_wrap'     => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
            ] );
            ?>
        </nav>

        <!-- Botón hamburguesa — móvil -->
        <button
            id="cspm-menu-toggle"
            class="cspm-menu-toggle"
            aria-controls="cspm-nav-primary"
            aria-expanded="false"
            aria-label="<?php esc_attr_e( 'Abrir menú', 'cspm-institucional' ); ?>"
            type="button"
        >
            <span class="cspm-menu-toggle__bar" aria-hidden="true"></span>
            <span class="cspm-menu-toggle__bar" aria-hidden="true"></span>
            <span class="cspm-menu-toggle__bar" aria-hidden="true"></span>
        </button>

    </div><!-- .cspm-header-inner -->
</header>

<?php
/**
 * Fallback de navegación si no hay menú asignado.
 * Muestra las páginas estáticas del sitio.
 */
function cspm_fallback_nav(): void {
    echo '<ul class="cspm-nav__list" role="list">';
    wp_list_pages( [
        'title_li' => '',
        'depth'    => 1,
        'echo'     => true,
    ] );
    echo '</ul>';
}
