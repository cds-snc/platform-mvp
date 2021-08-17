<?php
/**
* The template for displaying archive pages
*
*/

get_header();
?>
<main id="main" class="site-main mt-5">
  
  <?php if ( have_posts() ) : ?>
      <div class="container">
        <header class="archive-header row">
          <h1 class="archive-title col-12"><?php post_type_archive_title() ?></h1>
          <div class="archive-description col-md-6 col-lg-8"></div>
        </header><!-- .page-header -->
        
        <div class="archive-search">
            <div class="row">
                <?php get_template_part( 'template-parts/components/searchform' );?>
            </div> 
        </div>

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
  </main><!-- #main -->
  
  <?php
  get_footer();
