<?php
/**
 * The template used for displaying page content
 *
 * @subpackage fPhotography
 * @author tishonator
 * @since fPhotography 1.0.0
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1 class="entry-title"><?php the_title(); ?></h1>
	
	<div class="page-content">
		<?php fphotography_the_content_single(); ?>
	</div><!-- .page-content -->

	<div class="page-after-content">
		
		<?php if ( ! post_password_required() ) : ?>

			<?php if ('open' == $post->comment_status) : ?>

				<span class="comments-icon">
					<?php comments_popup_link(__( 'No Comments', 'fphotography' ), __( '1 Comment', 'fphotography' ), __( '% Comments', 'fphotography' ), '', __( 'Comments are closed.', 'fphotography' )); ?>
				</span>

			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'fphotography' ), '<span class="edit-icon">', '</span>' ); ?>
		<?php endif; ?>

	</div><!-- .page-after-content -->
</article><!-- #post-## -->

