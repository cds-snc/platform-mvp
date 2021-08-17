<?php
/**
* The template for displaying archive pages
*
*/

get_header();
?>
<main id="main" class="site-main mt-5">
  
  <div class="container">
    <header class="post-header">
    </header><!-- .page-header -->
      
    <div id="main__content" class="row">      
      <?php get_template_part( 'template-parts/content/content', 'none' ); ?>
    </div>
  </div>
</main><!-- #main -->
  
<?php get_footer();
