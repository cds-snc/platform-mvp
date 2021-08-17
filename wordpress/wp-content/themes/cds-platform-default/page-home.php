<?php
/*
Template Name: Homepage
*/
get_header();

?>
<?php

/* Start the Loop */
while ( have_posts() ) : 
	the_post(); ?>
	<main id="main" class="centered">
		
		<div class="container">
			<div class="row">
					<?php get_template_part( 'template-parts/content/content', 'home' ); ?>
			</div>
		</div>
		
	</main>

<?php endwhile; // End of the loop.
get_footer();?>
