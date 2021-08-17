
<form class="form-flex" action="<?php echo home_url('/'); ?>" method="get">
  <?php 
  
   ?>
  <div class="form-group form-group--wide">
    <label for="search">Search by Keywords</label>
    <input class="form-control <?php echo mb_strtolower(wp_get_theme()->name) ?>-form-control-lg" id="search" name="s" placeholder="Search by Keywords" type="search" tabindex="0" autocomplete="off" autocapitalize="none" spellcheck="false" value="<?php the_search_query(); ?>">
  </div>
  
  <input type="hidden" name="post_type" value="post" />
  <div class="form-submit">
    <!-- <input type="reset" id="reset-form" class="btn btn-light" value="Reset"> -->
    <input type="submit" class="btn btn-primary <?php echo mb_strtolower(wp_get_theme()->name) ?>-search__button" value="Search">
  </div>
</form>
