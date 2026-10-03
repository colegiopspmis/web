<?php
/**
 * inc/acf-fields.php — Campos personalizados ACF para la portada
 *
 * Define los campos ACF (Advanced Custom Fields) que permitirán migrar
 * el contenido de Brizy a campos nativos en el futuro.
 *
 * Actualmente registra campos para:
 *  - El Colegio (datos institucionales)
 *  - Contacto (formulario y mapa)
 *
 * Solo se ejecuta si ACF está activo (función_exists check).
 *
 * @package cspm-institucional
 */

defined( 'ABSPATH' ) || exit;

// Solo cargar si ACF está disponible
if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

// ── Grupo: Datos Institucionales (Página "El Colegio") ─────────────────
acf_add_local_field_group( [
    'key'    => 'group_cspm_el_colegio',
    'title'  => __( 'Datos Institucionales — El Colegio', 'cspm-institucional' ),
    'fields' => [
        [
            'key'           => 'field_cspm_mision',
            'label'         => __( 'Misión', 'cspm-institucional' ),
            'name'          => 'cspm_mision',
            'type'          => 'textarea',
            'rows'          => 4,
            'instructions'  => __( 'Descripción de la misión institucional del Colegio.', 'cspm-institucional' ),
        ],
        [
            'key'           => 'field_cspm_vision',
            'label'         => __( 'Visión', 'cspm-institucional' ),
            'name'          => 'cspm_vision',
            'type'          => 'textarea',
            'rows'          => 4,
        ],
        [
            'key'           => 'field_cspm_valores',
            'label'         => __( 'Valores', 'cspm-institucional' ),
            'name'          => 'cspm_valores',
            'type'          => 'textarea',
            'rows'          => 4,
        ],
        [
            'key'           => 'field_cspm_historia',
            'label'         => __( 'Historia', 'cspm-institucional' ),
            'name'          => 'cspm_historia',
            'type'          => 'wysiwyg',
            'toolbar'       => 'basic',
            'media_upload'  => 0,
        ],
        [
            'key'           => 'field_cspm_autoridades',
            'label'         => __( 'Autoridades', 'cspm-institucional' ),
            'name'          => 'cspm_autoridades',
            'type'          => 'repeater',
            'button_label'  => __( 'Agregar Autoridad', 'cspm-institucional' ),
            'sub_fields'    => [
                [
                    'key'   => 'field_cspm_auto_nombre',
                    'label' => __( 'Nombre', 'cspm-institucional' ),
                    'name'  => 'nombre',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_cspm_auto_cargo',
                    'label' => __( 'Cargo', 'cspm-institucional' ),
                    'name'  => 'cargo',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_cspm_auto_foto',
                    'label' => __( 'Foto', 'cspm-institucional' ),
                    'name'  => 'foto',
                    'type'  => 'image',
                    'return_format' => 'array',
                    'preview_size'  => 'cspm-thumb',
                ],
            ],
        ],
    ],
    'location' => [
        [ [ 'param' => 'page', 'operator' => '==', 'value' => 'el-colegio' ] ],
    ],
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => [ 'the_content' ], // Ocultar editor nativo para usar solo ACF
] );


// ── Grupo: Datos de Contacto (Página "Contacto") ───────────────────────
acf_add_local_field_group( [
    'key'    => 'group_cspm_contacto',
    'title'  => __( 'Datos de Contacto', 'cspm-institucional' ),
    'fields' => [
        [
            'key'          => 'field_cspm_email_contacto',
            'label'        => __( 'Email de Contacto', 'cspm-institucional' ),
            'name'         => 'cspm_email_contacto',
            'type'         => 'email',
            'default_value'=> 'colegiopspmisiones@gmail.com',
        ],
        [
            'key'   => 'field_cspm_telefono',
            'label' => __( 'Teléfono', 'cspm-institucional' ),
            'name'  => 'cspm_telefono',
            'type'  => 'text',
        ],
        [
            'key'           => 'field_cspm_direccion',
            'label'         => __( 'Dirección Física', 'cspm-institucional' ),
            'name'          => 'cspm_direccion',
            'type'          => 'text',
            'default_value' => 'Rivadavia 1436, Posadas, Misiones',
        ],
        [
            'key'   => 'field_cspm_horario',
            'label' => __( 'Horario de Atención', 'cspm-institucional' ),
            'name'  => 'cspm_horario',
            'type'  => 'textarea',
            'rows'  => 3,
        ],
        [
            'key'          => 'field_cspm_embed_mapa',
            'label'        => __( 'Código Embed del Mapa (Google Maps)', 'cspm-institucional' ),
            'name'         => 'cspm_embed_mapa',
            'type'         => 'textarea',
            'rows'         => 4,
            'instructions' => __( 'Pegar el código iframe de Google Maps. El tema lo renderizará de forma segura.', 'cspm-institucional' ),
        ],
    ],
    'location' => [
        [ [ 'param' => 'page', 'operator' => '==', 'value' => 'contacto' ] ],
    ],
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
] );
