<?php
/** Opciones de redes sociales y vídeo institucional. */

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

    // ── Sección: Identidad y menú ──────────────────────────────────────
    $wp_customize->add_section( 'cspm_identity', [
        'title'    => __( 'Logo del pie y botón Autogestión', 'cspm-institucional' ),
        'panel'    => 'cspm_panel',
        'priority' => 5,
    ] );

    $wp_customize->add_setting( 'cspm_footer_logo', [
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'cspm_footer_logo', [
        'label'       => __( 'Logo blanco del pie de página', 'cspm-institucional' ),
        'description' => __( 'Opcional. Si no se elige ninguno, se usa el logo blanco incluido en el tema.', 'cspm-institucional' ),
        'section'     => 'cspm_identity',
        'mime_type'   => 'image',
    ] ) );

    $wp_customize->add_setting( 'cspm_autogestion_url', [
        'default'           => 'https://autogestion.colegiopspmisiones.com.ar/',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'cspm_autogestion_url', [
        'label'       => __( 'Autogestión — URL', 'cspm-institucional' ),
        'description' => __( 'Enlace del botón del menú. Déjalo vacío para ocultar el botón.', 'cspm-institucional' ),
        'section'     => 'cspm_identity',
        'type'        => 'url',
    ] );

    $wp_customize->add_setting( 'cspm_autogestion_label', [
        'default'           => 'Autogestión',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'cspm_autogestion_label', [
        'label'   => __( 'Autogestión — Texto del botón', 'cspm-institucional' ),
        'section' => 'cspm_identity',
        'type'    => 'text',
    ] );

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

}
