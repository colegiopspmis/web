<?php
defined('ABSPATH') || exit;

function cspm_social_url(string $network): string {
    $defaults = [
        'instagram'=>'https://www.instagram.com/colegiopspmisiones/',
        'facebook'=>'https://www.facebook.com/colegiopspmisiones/',
        'youtube'=>'https://www.youtube.com/@colegiopspmisiones6629',
    ];
    if (!isset($defaults[$network])) { return ''; }
    $saved = trim((string)get_theme_mod('cspm_social_'.$network,''));
    return esc_url_raw($saved ?: $defaults[$network]);
}

function cspm_communication_links(): void {
    echo '<section class="cspm-communication" aria-labelledby="cspm-communication-title"><h2 id="cspm-communication-title">Seguí en contacto con el Colegio</h2><p>Novedades, actividades y contenidos institucionales en nuestras redes.</p><nav class="cspm-communication-links" aria-label="Redes del Colegio">';
    foreach (['instagram'=>'Instagram','facebook'=>'Facebook','youtube'=>'YouTube'] as $network=>$label) {
        echo '<a href="'.esc_url(cspm_social_url($network)).'" target="_blank" rel="noopener noreferrer">'.esc_html($label).'</a>';
    }
    echo '</nav>';
    $content = (string)get_post_field('post_content',get_the_ID());
    if (!str_contains(preg_replace('/\D/','',$content),'3764906540')) {
        echo '<p><a class="cspm-btn cspm-btn--primary" href="https://wa.me/5493764906540" target="_blank" rel="noopener noreferrer">WhatsApp institucional · +54 9 376 490-6540</a></p>';
    }
    echo '</section>';
}
