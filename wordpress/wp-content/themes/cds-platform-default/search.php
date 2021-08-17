<?php
/**
* The template for displaying archive pages
*
*/

get_header();
?>
<main id="main" class="site-main">
  
  
  
  
  <?php if ( have_posts() ) : ?>
    <header class="post-header">
      <div class="container">
        <div class="row">
          <?php get_template_part( 'template-parts/components/searchform' );?>
        </div>
      </div>
    </header><!-- .page-header -->
    
    <div class="container">
      <div id="main__content" class="row">
        <?php if (get_query_var('s')): ?>
          <h1 class="col-12 featured-row__title"><?php echo "$wp_query->found_posts search results for &ldquo;".get_query_var('s')."&rdquo;"; ?></h1>
        <?php endif; ?>
        <?php while ( have_posts() ) : the_post();?>
          <div class="col-lg-3">
            <?php get_template_part( 'template-parts/content/content-card', get_post_type() ); ?>
          </div>
          
        <?php endwhile;?>
        
        <div class="load-more col-12 d-none">
          <?php get_template_part( 'template-parts/components/loadmore', 'auto' ); ?>
          <!-- <a class="btn btn-primary btn-loadmore">Load More</a> -->
        </div>
      </div>
    </div>
    
  <?php else : // If no content, include the "No posts found" template.
    ?>
    <div class="container">
      <div id="main__content" class="row">
        <?php get_template_part( 'template-parts/content/content', 'none' ); ?>
      </div>
    </div>
  <?php endif; ?>
  
  
</main><!-- #main -->

<?php get_footer();
