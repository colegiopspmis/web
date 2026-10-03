<?php
/** Insert news after the existing native hero, without rewriting saved content. */
defined('ABSPATH') || exit;

function cspm_home_content(): void {
    $inserted = false;
    $filter = static function ($html, $block) use (&$inserted) {
        $classes = preg_split('/\s+/', trim($block['attrs']['className'] ?? ''));
        if (!$inserted && in_array('cspm-identity-hero', $classes, true)) {
            $inserted = true;
            ob_start();
            get_template_part('template-parts/home-news');
            $html .= ob_get_clean();
        }
        return $html;
    };
    add_filter('render_block', $filter, 30, 2);
    try { the_content(); }
    finally { remove_filter('render_block', $filter, 30); }
    // Safe fallback for front pages whose editor no longer contains the hero block.
    if (!$inserted) { get_template_part('template-parts/home-news'); }
}
