<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__.'/inc/template-filters.php';

/**
 * cds-default functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cds-default
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (! function_exists('cds_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function cds_setup(): void
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on cds-default, use a find and replace
         * to change 'cds' to the name of your theme in all the template files.
         */
        load_theme_textdomain('cds', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            [
                'menu-1' => esc_html__('Primary', 'cds'),
            ]
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );
    }
}
add_action('after_setup_theme', 'cds_setup');

/**
 * Enqueue scripts and styles.
 */
function cds_scripts(): void
{
    wp_enqueue_style('cds-style', get_stylesheet_uri(), [], _S_VERSION);
}
add_action('wp_enqueue_scripts', 'cds_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

function the_crumb($crumb, $sep = "")
{
    //if (preg_match('/\\<span\\40class=\\"breadcrumb_last\\"/\', $crumb)) {
        
    //}

    return '<li>' . $crumb . ' <span class="divider">' . $sep . '</span></li>';
}

function the_breadcrumbs($sep = '')
{
    if (!function_exists('yoast_breadcrumb')) {
        return null;
    }
    // Default Yoast Breadcrumbs Separator
    //  $old_sep = '\&raquo\;';
    $old_sep = '»';
    // Get the crumbs
    echo $crumbs = yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
    
}
