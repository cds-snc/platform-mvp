      
      <!-- footer -->
      <div class="border-t-4 border-blue">
        <footer class="container py-10">
          <div class="flex justify-between">
            <div>
              <?php wp_nav_menu(['theme_location' => 'footer']); ?>
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
      </div>
    </body>
    <?php wp_footer(); ?>
</html>
