<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- Required meta tags-->
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <?php $canadian_digital_service_description = get_bloginfo('description', 'display'); ?>
		    <meta name="description" content="<?php echo $canadian_digital_service_description; ?>">
        <link rel="shortcut icon" href="<?php echo get_favicon('favicon.png'); ?>" type="image/x-icon" sizes="32x32">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet" />
		    <?php wp_head(); ?>
		<title><?php bloginfo('name'); ?></title>	
    </head>
    <body>
      <div>

        <!-- start header -->
        <header>
        <!-- phase banner -->
        <div class="bg-gray py-3">
          <div class="container mx-auto px-100">
            <span
              class="py-1 px-2 border-solid border-2 border-black inline-flex mr-5 text-sm"
              >ALPHA</span
            ><span class="text-base">This site will change as we test ideas.</span>
          </div>
        </div>
        <!-- end phase banner -->

        <!-- FIP -->
        <div class="container mx-auto">
          <div class="md:flex justify-between py-10">
            <div class="canada-flag">
              <a href="/" aria-label="Government of Canada">
                <img
                  class="w-84 mb-5 md:mb-0"
                  src="<?php echo get_image_directory('sig-blk-en.svg'); ?>"
                  alt="Government of Canada"
                />
              </a>
            </div>

            <div>
              <?php icl_post_languages(); ?>
            </div>
          </div>
        </div>

        <!-- end FIP -->
      </header>
      <!-- end header -->