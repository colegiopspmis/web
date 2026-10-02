<?php
/** Tema independiente para una instalación nueva. */
defined( 'ABSPATH' ) || exit;
define( 'CSPM_VERSION', '1.4.1' );
define( 'CSPM_DIR', get_template_directory() );
define( 'CSPM_URI', get_template_directory_uri() );
define( 'CSPM_ASSETS', CSPM_URI . '/assets' );

add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'cspm-institucional', CSPM_DIR . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [ 'flex-width' => true, 'flex-height' => true ] );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    register_nav_menus( [ 'primary' => __( 'Menú principal', 'cspm-institucional' ), 'footer' => __( 'Pie de página', 'cspm-institucional' ) ] );
    add_image_size( 'cspm-hero', 1920, 800, true );
    add_image_size( 'cspm-card', 600, 400, true );
    add_image_size( 'cspm-thumb', 400, 300, true );
} );

/**
 * Versión de un asset para el query string (?ver=). Combina la versión del tema con un
 * hash corto del contenido del archivo: cambia SOLO cuando el archivo cambia, así
 * navegador, LiteSpeed y Cloudflare descargan la copia nueva tras cada despliegue.
 */
function cspm_asset_ver( string $rel ): string {
    $file = CSPM_DIR . '/assets/' . ltrim( $rel, '/' );
    return is_readable( $file ) ? CSPM_VERSION . '-' . substr( md5_file( $file ), 0, 8 ) : CSPM_VERSION;
}

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'cspm-main', CSPM_ASSETS . '/css/main.css', [], cspm_asset_ver( 'css/main.css' ) );
    wp_enqueue_style( 'cspm-identity', CSPM_ASSETS . '/css/identity.css', [ 'cspm-main' ], cspm_asset_ver( 'css/identity.css' ) );
    wp_enqueue_script( 'cspm-main', CSPM_ASSETS . '/js/main.js', [], cspm_asset_ver( 'js/main.js' ), [ 'strategy' => 'defer', 'in_footer' => true ] );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
} );

// Divi Builder debe instalarse desde su proveedor para entradas con sus shortcodes.
add_filter( 'et_builder_post_types', function ( $types ) { return [ 'post' ]; } );

/**
 * Botón "Autogestión" del menú principal. Se edita en Personalizar > CSPM — Opciones del Tema.
 * Si la URL se deja vacía en el Personalizador, el botón no se muestra.
 */
function cspm_autogestion(): array {
    $url   = (string) get_theme_mod( 'cspm_autogestion_url', 'https://autogestion.colegiopspmisiones.com.ar/' );
    $label = trim( (string) get_theme_mod( 'cspm_autogestion_label', 'Autogestión' ) );
    return [
        'url'   => esc_url_raw( $url ),
        'label' => '' !== $label ? $label : 'Autogestión',
    ];
}

function cspm_asset_url( string $path ): string {
    return esc_url( CSPM_ASSETS . '/' . ltrim( $path, '/' ) );
}
function cspm_youtube_url( string $video_id ): string {
    return esc_url( 'https://www.youtube.com/watch?v=' . rawurlencode( $video_id ) );
}
function cspm_news_url(): string {
    $page_id = (int) get_option( 'page_for_posts' );
    if ( $page_id && 'publish' === get_post_status( $page_id ) ) {
        return get_permalink( $page_id );
    }
    return add_query_arg( [ 's' => '', 'post_type' => 'post' ], home_url( '/' ) );
}

add_action( 'widgets_init', function () {
    register_sidebar( [
        'name' => __( 'Pie de página', 'cspm-institucional' ), 'id' => 'footer-col-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>',
    ] );
} );
require_once CSPM_DIR . '/inc/customizer.php';
require_once CSPM_DIR . '/inc/documents.php';
