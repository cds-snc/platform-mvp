<?php

get_header();

?>

	<main id="main" class="centered">
		
		<div class="homepage-header">
			<div class="container">
				<header class="post-header row">
					<div class="col-md-8">
						<h1 class="post-title">
							<?php echo get_bloginfo('description') ?>
						</h1>
					</div>
				</header>
			</div>
		</div>

	  <?php if ( have_posts() ) : ?>
	      <div class="container">
	        
	        <div id="main__content" class="row">
	          
	          
	          <?php while ( have_posts() ) : the_post();?>
	            
	            <div class="col-md-4 col-lg-3">
	              <?php get_template_part( 'template-parts/content/content-card', get_post_type() ); ?>
	            </div>
	            
	          <?php endwhile;?>
	          
	          
	        </div>
	        
	        <div class="row">  
	          <div class="load-more col-12">
	            <?php get_template_part( 'template-parts/components/loadmore', 'auto' ); ?>
	          </div>
	          
	        </div>
	      </div>
	    <?php
	    // If no content, include the "No posts found" template.
	    else :
	      get_template_part( 'template-parts/content/content', 'none' );
	      
	    endif; ?>
		
	</main>

<?php get_footer();?>
