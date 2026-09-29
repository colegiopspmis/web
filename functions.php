<?php
/**
 * functions.php — Núcleo del tema CSPM Institucional
 *
 * Responsabilidades:
 *  1. Configuración del tema (soporte de características de WordPress)
 *  2. Encole de activos (CSS/JS vanilla, sin dependencias de constructores)
 *  3. Control quirúrgico de Divi y Brizy:
 *     - Divi Builder → solo en post_type 'post' (entradas heredadas)
 *     - Brizy        → solo en páginas pre-existentes de la lista blanca
 *  4. Eliminación de bloatware (emojis, oEmbed excesivo, prefetch de WP)
 *  5. Registro de menús, widgets y campos de opciones del tema
 *  6. Correcciones de auditoría SEO (title tag, Open Graph básico)
 *  7. Redirección: /tramites/ → /tramites-2/ gestionada aquí para no depender de plugins
 *
 * @package cspm-institucional
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

// ─────────────────────────────────────────────────────────────────────────────
// 0. CONSTANTES GLOBALES DEL TEMA
// ─────────────────────────────────────────────────────────────────────────────

define( 'CSPM_VERSION',   '1.0.0' );
define( 'CSPM_DIR',       get_template_directory() );
define( 'CSPM_URI',       get_template_directory_uri() );
define( 'CSPM_ASSETS',    CSPM_URI  . '/assets' );
define( 'CSPM_INC',       CSPM_DIR  . '/inc' );


// ─────────────────────────────────────────────────────────────────────────────
// 1. SETUP DEL TEMA
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'after_setup_theme', 'cspm_theme_setup' );
/**
 * Declara las características de WordPress que el tema soporta.
 */
function cspm_theme_setup(): void {

    load_theme_textdomain( 'cspm-institucional', CSPM_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );          // WP gestiona <title> correctamente
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );     // compatibilidad pasiva con Gutenberg

    // Tamaños de imagen personalizados
    add_image_size( 'cspm-hero',    1920, 800,  true );
    add_image_size( 'cspm-card',     600, 400,  true );
    add_image_size( 'cspm-thumb',    400, 300,  true );

    // Menús de navegación
    register_nav_menus( [
        'primary'  => __( 'Menú Principal',    'cspm-institucional' ),
        'footer'   => __( 'Menú Pie de Página','cspm-institucional' ),
        'mobile'   => __( 'Menú Móvil',        'cspm-institucional' ),
    ] );
}


// ─────────────────────────────────────────────────────────────────────────────
// 2. ENCOLE DE ACTIVOS
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', 'cspm_enqueue_assets' );
/**
 * Encola CSS y JS vanilla del tema.
 * Google Fonts se carga con preconnect + display=swap para CWV (LCP).
 */
function cspm_enqueue_assets(): void {

    // ── Google Fonts: Inter (UI) + Merriweather (headings institucionales)
    wp_enqueue_style(
        'cspm-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@400;700&display=swap',
        [],
        null
    );

    // ── CSS Principal del tema
    wp_enqueue_style(
        'cspm-main',
        CSPM_ASSETS . '/css/main.css',
        [ 'cspm-fonts' ],
        CSPM_VERSION
    );

    // ── JS Principal (vanilla, tipo module para tree-shaking nativo)
    wp_enqueue_script(
        'cspm-main',
        CSPM_ASSETS . '/js/main.js',
        [],
        CSPM_VERSION,
        [ 'strategy' => 'defer', 'in_footer' => true ]
    );

    // ── Datos inline: pasa variables PHP → JS de forma segura
    wp_localize_script( 'cspm-main', 'CSPM', [
        'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'cspm_nonce' ),
        'homeUrl'  => esc_url( home_url( '/' ) ),
        'themeUri' => esc_url( CSPM_URI ),
        'isHome'   => is_front_page(),
    ] );

    // ── CSS de comentarios (solo si la entrada los tiene habilitados)
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

// preconnect para Google Fonts (mejora LCP)
add_action( 'wp_head', 'cspm_preconnect_fonts', 1 );
function cspm_preconnect_fonts(): void {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}


// ─────────────────────────────────────────────────────────────────────────────
// 3. CONTROL DE DIVI BUILDER
//    → Habilitado EXCLUSIVAMENTE en post_type 'post' (entradas heredadas)
// ─────────────────────────────────────────────────────────────────────────────

add_filter( 'et_builder_post_types', 'cspm_limit_divi_to_posts' );
/**
 * Restringe el Divi Builder únicamente al post_type 'post'.
 * Esto preserva el formato heredado de las entradas sin contaminar páginas.
 *
 * @param  array $post_types Post types donde Divi está habilitado.
 * @return array
 */
function cspm_limit_divi_to_posts( array $post_types ): array {
    return [ 'post' ]; // Solo entradas
}

// Desactiva el módulo Divi Theme Options CSS en el front-end para limpiar salida
add_filter( 'et_load_unminified_scripts', '__return_false' );
add_filter( 'et_load_unminified_styles',  '__return_false' );

// Suprime el CSS global de Divi en páginas y portada (lo gestiona nuestro CSS)
add_action( 'wp_enqueue_scripts', 'cspm_suppress_divi_global_css', 999 );
function cspm_suppress_divi_global_css(): void {
    if ( ! is_singular( 'post' ) ) {
        wp_dequeue_style( 'et-divi-style' );
        wp_dequeue_style( 'et_pb_root_global_presets' );
        wp_dequeue_style( 'et_pb_global_css' );
    }
}


// ─────────────────────────────────────────────────────────────────────────────
// 4. CONTROL DE BRIZY
//    → Activo solo en páginas de la lista blanca mientras se migran
// ─────────────────────────────────────────────────────────────────────────────

add_filter( 'brizy_allowed_post_types', 'cspm_limit_brizy_to_whitelist' );
/**
 * Lista blanca de slugs de páginas donde Brizy permanece activo temporalmente.
 * Cuando una página sea migrada a campos personalizados, quitarla de este array.
 *
 * @param  array $post_types
 * @return array
 */
function cspm_limit_brizy_to_whitelist( array $post_types ): array {

    $brizy_whitelist_slugs = [
        'el-colegio',
        'contacto',
        // ← Agregar aquí otros slugs mientras se migran
    ];

    global $post;
    if ( isset( $post->post_name ) && in_array( $post->post_name, $brizy_whitelist_slugs, true ) ) {
        return [ 'page' ];
    }

    return []; // Brizy deshabilitado en el resto
}

// Desencolar activos de Brizy donde no sea necesario
add_action( 'wp_enqueue_scripts', 'cspm_suppress_brizy_assets', 998 );
function cspm_suppress_brizy_assets(): void {
    global $post;

    $brizy_whitelist = [ 'el-colegio', 'contacto' ];

    if (
        ! is_singular()
        || ! isset( $post->post_name )
        || ! in_array( $post->post_name, $brizy_whitelist, true )
    ) {
        wp_dequeue_style(  'brizy-preview' );
        wp_dequeue_script( 'brizy-preview' );
        wp_dequeue_style(  'brizy-admin' );
    }
}


// ─────────────────────────────────────────────────────────────────────────────
// 5. ELIMINACIÓN DE BLOATWARE
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'init', 'cspm_remove_bloatware' );
/**
 * Elimina scripts, estilos y cabeceras innecesarias que afectan el rendimiento.
 */
function cspm_remove_bloatware(): void {

    // Emojis de WordPress (innecesarios en sitio institucional)
    remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles',     'print_emoji_styles' );
    remove_action( 'admin_print_styles',  'print_emoji_styles' );
    remove_filter( 'the_content_feed',    'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss',    'wp_staticize_emoji' );
    remove_filter( 'wp_mail',            'wp_staticize_emoji_for_email' );

    // oEmbed: desactiva el script discovery (no necesitamos incrustar iframes externos en artículos)
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // Genera/XML-RPC headers
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );          // No exponer versión de WP
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );

    // Prefetch DNS de WordPress.org (irrelevante en producción)
    wp_resource_hints_prefetch_remove();
}

/**
 * Suprime el prefetch de s.w.org que WordPress agrega por defecto.
 */
function wp_resource_hints_prefetch_remove(): void {
    add_filter( 'wp_resource_hints', function( array $urls, string $relation_type ): array {
        if ( 'dns-prefetch' === $relation_type ) {
            $urls = array_filter( $urls, fn( $url ) => ! str_contains( (string) $url, 's.w.org' ) );
        }
        return $urls;
    }, 10, 2 );
}

// Desactiva Gutenberg en el admin para post_type 'page' (usamos campos personalizados)
add_filter( 'use_block_editor_for_post_type', 'cspm_disable_gutenberg_for_pages', 10, 2 );
function cspm_disable_gutenberg_for_pages( bool $use_block_editor, string $post_type ): bool {
    if ( 'page' === $post_type ) {
        return false;
    }
    return $use_block_editor;
}


// ─────────────────────────────────────────────────────────────────────────────
// 6. CORRECCIÓN REDIRECCIÓN /tramites/ → /tramites-2/
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'template_redirect', 'cspm_redirect_tramites' );
/**
 * Redirige /tramites/ a /tramites-2/ con 301 permanente.
 * Evita depender de plugins de redirección para esta URL crítica.
 */
function cspm_redirect_tramites(): void {
    global $wp;
    $current_url = home_url( add_query_arg( [], $wp->request ) );

    if ( preg_match( '#/tramites/?$#i', $current_url ) ) {
        wp_safe_redirect( home_url( '/tramites-2/' ), 301 );
        exit;
    }
}


// ─────────────────────────────────────────────────────────────────────────────
// 7. MEJORAS SEO — TITLE TAG Y OPEN GRAPH BÁSICO
// ─────────────────────────────────────────────────────────────────────────────

add_filter( 'document_title_parts', 'cspm_fix_document_title' );
/**
 * Corrige el <title> de páginas específicas (ej: Contacto mostraba "| Colegio…").
 * Si se usa Yoast/AIOSEO, este filtro queda inactivo porque ellos toman prioridad.
 *
 * @param  array $title_parts
 * @return array
 */
function cspm_fix_document_title( array $title_parts ): array {

    // Página de Contacto
    if ( is_page( 'contacto' ) ) {
        $title_parts['title']   = __( 'Contacto', 'cspm-institucional' );
        $title_parts['tagline'] = __( 'Colegio de Psicopedagogos de Misiones', 'cspm-institucional' );
        unset( $title_parts['site'] ); // evita duplicación
    }

    // Portada: el <title> debe llevar el nombre completo de la institución
    if ( is_front_page() ) {
        $title_parts['title']   = __( 'Colegio de Psicopedagogos de Misiones', 'cspm-institucional' );
        $title_parts['tagline'] = __( 'Formación · Matrícula · Comunidad Profesional', 'cspm-institucional' );
        unset( $title_parts['site'] );
    }

    return $title_parts;
}

// Open Graph mínimo (para compartir en redes hasta que se instale un plugin SEO completo)
add_action( 'wp_head', 'cspm_open_graph_tags', 5 );
function cspm_open_graph_tags(): void {
    // Solo si no hay plugin SEO activo
    if ( defined( 'WPSEO_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
        return;
    }

    $og_title       = is_front_page()
        ? get_bloginfo( 'name' )
        : ( get_the_title() . ' – ' . get_bloginfo( 'name' ) );
    $og_description = is_front_page()
        ? get_bloginfo( 'description' )
        : wp_trim_words( get_the_excerpt(), 20 );
    $og_url         = get_permalink();
    $og_image       = has_post_thumbnail()
        ? get_the_post_thumbnail_url( null, 'cspm-hero' )
        : CSPM_ASSETS . '/images/og-default.jpg';

    printf( '<meta property="og:type"        content="website">' . "\n" );
    printf( '<meta property="og:site_name"   content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
    printf( '<meta property="og:title"       content="%s">' . "\n", esc_attr( $og_title ) );
    printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $og_description ) );
    printf( '<meta property="og:url"         content="%s">' . "\n", esc_url(  $og_url ) );
    printf( '<meta property="og:image"       content="%s">' . "\n", esc_url(  $og_image ) );
}


// ─────────────────────────────────────────────────────────────────────────────
// 8. SEGURIDAD: PROTECCIÓN DEL SISTEMA DE AUTOGESTIÓN
//    El subdominio Autogestión apunta a IP 149.50.146.236 (externo).
//    Aquí solo nos aseguramos de NO interferir con esa ruta en WP.
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'template_redirect', 'cspm_protect_autogestion_path' );
/**
 * Si por algún motivo WordPress captura una petición al directorio /autogestion/,
 * la redirige externamente al subdominio correcto.
 */
function cspm_protect_autogestion_path(): void {
    global $wp;
    if ( isset( $wp->request ) && str_starts_with( $wp->request, 'autogestion' ) ) {
        wp_redirect( 'https://autogestion.colegiopspmisiones.com.ar/', 302 );
        exit;
    }
}


// ─────────────────────────────────────────────────────────────────────────────
// 9. WIDGETS Y SIDEBAR
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'widgets_init', 'cspm_register_sidebars' );
function cspm_register_sidebars(): void {

    $defaults = [
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ];

    register_sidebar( array_merge( $defaults, [
        'name' => __( 'Sidebar Principal', 'cspm-institucional' ),
        'id'   => 'sidebar-main',
        'description' => __( 'Widgets del sidebar de entradas y páginas.', 'cspm-institucional' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name' => __( 'Footer — Columna 1', 'cspm-institucional' ),
        'id'   => 'footer-col-1',
        'description' => __( 'Primera columna del pie de página.', 'cspm-institucional' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name' => __( 'Footer — Columna 2', 'cspm-institucional' ),
        'id'   => 'footer-col-2',
        'description' => __( 'Segunda columna del pie de página.', 'cspm-institucional' ),
    ] ) );
}


// ─────────────────────────────────────────────────────────────────────────────
// 10. HELPERS DE PLANTILLA
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Retorna la URL del archivo de activos del tema de forma segura.
 *
 * @param  string $path Ruta relativa dentro de assets/
 * @return string URL absoluta escapada
 */
function cspm_asset_url( string $path ): string {
    return esc_url( CSPM_ASSETS . '/' . ltrim( $path, '/' ) );
}

/**
 * Imprime el enlace de YouTube de la portada de forma segura.
 * Corrige el bug del enlace concatenado roto detectado en auditoría.
 *
 * @param  string $video_id ID del video de YouTube
 * @return string URL válida
 */
function cspm_youtube_url( string $video_id ): string {
    return esc_url( 'https://www.youtube.com/watch?v=' . rawurlencode( $video_id ) );
}

/**
 * Incluye archivos de la carpeta /inc/ de forma segura.
 *
 * @param string $filename Nombre del archivo (sin .php)
 */
function cspm_require_inc( string $filename ): void {
    $file = CSPM_INC . '/' . $filename . '.php';
    if ( file_exists( $file ) ) {
        require_once $file;
    }
}

// Cargar módulos opcionales de /inc/
cspm_require_inc( 'customizer' );          // Opciones del Customizer
cspm_require_inc( 'acf-fields' );          // Campos ACF de la portada (si ACF está activo)
cspm_require_inc( 'nav-walker' );          // Walker de menú accesible


// ─────────────────────────────────────────────────────────────────────────────
// 11. COMPATIBILIDAD CON NINJA TABLES (/matriculados-2/)
//     Ninja Tables no requiere configuración especial de tema,
//     pero nos aseguramos de NO desencolar sus scripts en esa página.
// ─────────────────────────────────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', 'cspm_ensure_ninja_tables_assets', 1 );
function cspm_ensure_ninja_tables_assets(): void {
    // Ninja Tables detecta su shortcode automáticamente.
    // Aquí solo prevenimos que nuestras limpiezas lo afecten.
    if ( is_page( 'matriculados-2' ) ) {
        // Marcamos explícitamente para NO desencolar scripts de Ninja Tables
        add_filter( 'ninja_tables_force_load', '__return_true' );
    }
}
