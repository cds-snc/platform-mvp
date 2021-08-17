<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="profile" href="https://gmpg.org/xfn/11" />
  <link rel="shortcut icon" href="<?php echo get_favicon('favicon.png'); ?>" type="image/x-icon" sizes="32x32">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


  <header id="header">

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
            <img
            class="w-84"
            src="<?php echo get_image_directory('sig-blk-en.svg'); ?>"
            alt="Government of Canada"
            />
        </div>
      </div>
    </div>
    <!-- end FIP -->

	<!-- Site name -->
    <div id="site-name" class="container mx-auto mb-4 h2 font-weight-bold">
      <a href="<?php home_url(); ?>">
        <?php bloginfo( 'name' ); ?>
      </a>
    </div>
    <!-- end Site name -->

    <div class="bg-gray">
      <div class="container main-nav">
        <nav>
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'header-menu',
              'menu_class'     => 'navbar-nav',
              'container' => '',
              'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
              'walker' => new WP_Bootstrap_Navwalker(),
            )
          );
          ?>
        </nav>
      </div>
    </div>
  </header>
  
