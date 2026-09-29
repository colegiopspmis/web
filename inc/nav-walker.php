<?php
/**
 * inc/nav-walker.php — Walker de navegación accesible
 *
 * Extiende Walker_Nav_Menu para generar markup accesible:
 *  - Botón <button> en lugar de <a href="#"> para ítem padre con hijos
 *  - aria-haspopup / aria-expanded en los toggles de submenú
 *  - role="list" / role="listitem" para lectores de pantalla
 *
 * @package cspm-institucional
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'CSPM_Nav_Walker' ) ) :

class CSPM_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Abre el contenedor del ítem (<li>).
     */
    public function start_el(
        &$output,
        $data_object,
        $depth = 0,
        $args = null,
        $id = 0
    ): void {
        // Compatibilidad WordPress 5.9+
        $item = $data_object;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        if ( in_array( 'menu-item-has-children', $classes, true ) ) {
            $classes[] = 'cspm-has-submenu';
        }

        $class_names = implode( ' ', array_filter( array_map( 'trim', $classes ) ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id_attr = $id ? ' id="menu-item-' . esc_attr( (string) $id ) . '"' : '';

        $output .= $indent . '<li' . $id_attr . $class_names . ' role="listitem">';

        $atts          = [];
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';

        // Marcar el enlace actual
        if ( in_array( 'current-menu-item', $classes, true ) ) {
            $atts['aria-current'] = 'page';
        }

        // Si el ítem tiene hijos, añadir ARIA
        if ( in_array( 'menu-item-has-children', $classes, true ) ) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        // Añadir noopener para target="_blank"
        if ( '_blank' === $atts['target'] ) {
            $atts['rel'] = 'noopener noreferrer';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output  = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

endif; // class_exists
