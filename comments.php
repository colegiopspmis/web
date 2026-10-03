<?php
defined( 'ABSPATH' ) || exit;
if ( post_password_required() ) { return; }
?>
<section id="comments" class="cspm-comments" aria-label="<?php esc_attr_e( 'Comentarios', 'cspm-institucional' ); ?>">
<?php if ( have_comments() ) : ?>
<h2><?php esc_html_e( 'Comentarios', 'cspm-institucional' ); ?></h2>
<ol><?php wp_list_comments( [ 'style' => 'ol', 'short_ping' => true ] ); ?></ol>
<?php the_comments_pagination(); endif; comment_form(); ?>
</section>
