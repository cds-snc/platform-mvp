
  <!-- footer -->
      <div class="border-t-4 border-blue mt-5">
        <footer class="container py-10">
          <div class="flex justify-between">
            <div>
              <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'footer-menu',
                  'menu_class'     => 'navbar-nav',
                  'container' => '',
                  'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                  'walker' => new WP_Bootstrap_Navwalker(),
                )
              );
              ?>
            </div>
            <div class="canada-wordmark">
              <img
                class="w-40"
                src="<?php echo get_image_directory('wmms-blk.svg'); ?>"
                alt="Symbol of the Government of Canada"
              />
            </div>
          </div>
        </footer>
      </div>

      <!-- end footer -->
<?php wp_footer();?>
</body>
</html>
