<?php
/**
 * Template part for displaying post archives and search results
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("card"); ?>>
	<a href="<?php echo esc_url( get_permalink() ) ?>">
		<div class="card-img-top ratio-square">
		<?php if (has_post_thumbnail()): ?>
			<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'medium', false, array('class' => '')) ?>
		<?php endif; ?>
		</div>
		<div class="card-body">
			<h2 class="card-title">
				<?php echo get_the_title() ?>
			</h2>
		</div>
		<span class="card-meta">
			<?php echo get_the_excerpt() ?>
		</span>	
	</a>
	
</article>
