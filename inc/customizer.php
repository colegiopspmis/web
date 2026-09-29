<?php
/**
 * inc/customizer.php — Opciones del Customizer de WordPress
 *
 * Registra los controles de personalización del tema:
 *  - Redes sociales (Facebook, Instagram, YouTube)
 *  - Video YouTube institucional
 *  - Clave pública de Tidio (chatbot)
 *  - Colores de la paleta (en caso de querer ajustar sobre los defaults)
 *
 * @package cspm-institucional
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', 'cspm_customizer_register' );

function cspm_customizer_register( WP_Customize_Manager $wp_customize ): void {

    // ── Panel: CSPM Institucional ──────────────────────────────────────
    $wp_customize->add_panel( 'cspm_panel', [
        'title'       => __( 'CSPM — Opciones del Tema', 'cspm-institucional' ),
        'description' => __( 'Configuraciones específicas del Colegio de Psicopedagogos de Misiones.', 'cspm-institucional' ),
        'priority'    => 30,
    ] );

    // ── Sección: Redes Sociales ────────────────────────────────────────
    $wp_customize->add_section( 'cspm_social', [
        'title'    => __( 'Redes Sociales', 'cspm-institucional' ),
        'panel'    => 'cspm_panel',
        'priority' => 10,
    ] );

    $social_networks = [
        'cspm_social_facebook'  => [ 'label' => 'Facebook URL',  'placeholder' => 'https://facebook.com/colegiopspmisiones' ],
        'cspm_social_instagram' => [ 'label' => 'Instagram URL', 'placeholder' => 'https://instagram.com/colegiopspmisiones' ],
        'cspm_social_youtube'   => [ 'label' => 'YouTube Canal', 'placeholder' => 'https://youtube.com/@colegiopspmisiones' ],
    ];

    foreach ( $social_networks as $key => $meta ) {
        $wp_customize->add_setting( $key, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ] );
        $wp_customize->add_control( $key, [
            'label'       => $meta['label'],
            'section'     => 'cspm_social',
            'type'        => 'url',
            'input_attrs' => [ 'placeholder' => $meta['placeholder'] ],
        ] );
    }

    // ── Sección: Video Institucional ───────────────────────────────────
    $wp_customize->add_section( 'cspm_video', [
        'title'    => __( 'Video Institucional (YouTube)', 'cspm-institucional' ),
        'panel'    => 'cspm_panel',
        'priority' => 20,
    ] );

    $wp_customize->add_setting( 'cspm_youtube_video_id', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'cspm_youtube_video_id', [
        'label'       => __( 'ID del Video de YouTube', 'cspm-institucional' ),
        'description' => __( 'Solo el ID (ej: dQw4w9WgXcQ), no la URL completa.', 'cspm-institucional' ),
        'section'     => 'cspm_video',
        'type'        => 'text',
        'input_attrs' => [ 'placeholder' => 'dQw4w9WgXcQ' ],
    ] );

    // ── Sección: Chatbot Tidio ─────────────────────────────────────────
    $wp_customize->add_section( 'cspm_tidio', [
        'title'    => __( 'Chatbot Tidio (psicopebot-simple)', 'cspm-institucional' ),
        'panel'    => 'cspm_panel',
        'priority' => 30,
    ] );

    $wp_customize->add_setting( 'cspm_tidio_public_key', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'cspm_tidio_public_key', [
        'label'       => __( 'Clave Pública de Tidio', 'cspm-institucional' ),
        'description' => __( 'Se encuentra en el panel de Tidio → Settings → Installation → Public Key. No ingresar la clave privada.', 'cspm-institucional' ),
        'section'     => 'cspm_tidio',
        'type'        => 'text',
        'input_attrs' => [ 'placeholder' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' ],
    ] );
}
