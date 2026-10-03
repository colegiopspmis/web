<?php
/** Compatibilidad de bloques existentes; no modifica la base de datos. */
defined( 'ABSPATH' ) || exit;

add_filter( 'render_block', function ( $html, $block ) {
    if ( is_admin() || ! is_page() || get_the_ID() !== get_queried_object_id() ) {
        return $html;
    }
    // La plantilla ya proporciona el H1. Quitar solo el título duplicado conocido.
    if ( 'core/heading' === $block['blockName'] && is_page( [ 'autoridades', 'el-colegio', 'documentos' ] ) ) {
        $title = trim( wp_strip_all_tags( $html ) );
        if ( in_array( $title, [ get_the_title(), 'Autoridades del Colegio' ], true ) ) {
            return '';
        }
    }
    if ( 'core/image' === $block['blockName'] && is_page( 'autoridades' ) ) {
        $photos = [
            '/wp-content/uploads/PRESIDENTE-scaled.jpg' => 'mariana-sinsolo.jpg',
            '/wp-content/uploads/VICE-PRESIDENTE-scaled.jpg' => 'agustina-rodriguez.jpg',
            '/wp-content/uploads/SECRETARIA-scaled.jpg' => 'mercedes-rios.jpg',
            '/wp-content/uploads/TESORERA-scaled.jpg' => 'genoveva-cazal-nelli.jpg',
        ];
        $tags = new WP_HTML_Tag_Processor( $html );
        if ( $tags->next_tag( 'IMG' ) ) {
            $src = (string) $tags->get_attribute( 'src' );
            $path = wp_parse_url( $src, PHP_URL_PATH );
            $file = $photos[ $path ] ?? null;
            // Los nuevos bloques también resuelven la URL del tema en cada instalación.
            foreach ( $photos as $candidate ) {
                if ( '/wp-content/themes/cspm-institucional/assets/images/autoridades/' . $candidate === $path ) {
                    $file = $candidate;
                }
            }
            if ( $file ) {
                $tags->set_attribute( 'src', CSPM_ASSETS . '/images/autoridades/' . $file );
                $tags->remove_attribute( 'srcset' );
                $tags->remove_attribute( 'sizes' );
                $tags->set_attribute( 'decoding', 'async' );
                return $tags->get_updated_html();
            }
        }
    }
    return $html;
}, 10, 2 );
