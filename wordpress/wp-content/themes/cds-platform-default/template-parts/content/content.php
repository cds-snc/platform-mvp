<?php
/**
 * Template part for displaying posts
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("col"); ?>>
	
	<header class="post-header">
		<h1 class="post-title"><?php echo get_the_title() ?></h1>
	</header>
	
	<div class="post-content">		

			<?php the_content() ?>

	</div>

	<!-- <footer class="post-footer">
	</footer> -->
</article>
