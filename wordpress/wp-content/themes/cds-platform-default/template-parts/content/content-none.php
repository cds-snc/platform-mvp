<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 */

?>
<div class="container">
	<div class="row">
		<header class="post-header col mx-auto">
			<h1 class="post-title">Nothing Found</h1>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentynineteen' ); ?></p>
		</header>
<!-- .page-header -->

<section class="no-results not-found">

		<?php get_template_part( 'template-parts/components/searchform' );?>
<!-- .page-content -->
</section><!-- .no-results -->

	</div>
</div>