<section class="sidebar-nav col col-md-4">
  <nav class="nav-doc" data-screen="desktop">
    <?php 
      wp_list_pages(array(
        'post_type' => 'documentation',
        'title_li' => '',
      ));
    ?>
  </nav>

  <details class="nav-doc" data-screen="mobile">
    <summary class="nav-toggle">
      <div><?php _e('Documentation')?></div></summary>
    <nav aria-label="<?php _e('Table of contents')?>: <?php _e('Documentation')?>">
      <?php 
        wp_list_pages(array(
          'post_type' => 'documentation',
          'title_li' => '',
        ));
      ?>
    </nav>  
  </details>
  
</section>