<?php
/*
Template Name: Documentation
*/
get_header();

?>

<main id="main" class="site-main mt-5">
	
		<?php

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();?>
			
			<div class="container">
				<div class="row">
					<?php get_template_part( 'template-parts/components/sidebar' ); ?>	
					<?php get_template_part( 'template-parts/content/content' ); ?>
				</div>
			</div>
			
		<?php endwhile; // End of the loop. ?>

</main><!-- #main -->
<?php
get_footer();
