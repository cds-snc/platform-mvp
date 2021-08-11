<?php
/**
 * Canadian Digital Service functions and definitions.
 *
 * @see https://developer.wordpress.org/themes/basics/theme-functions/
 */
$inc = get_template_directory().'/inc/';

require_once $inc.'log.php';
require_once $inc.'check-user.php';
require_once $inc.'forms.php';

// custom admin page
require_once $inc.'admin-panel.php';
require_once $inc.'clean-up.php';
require_once $inc.'dashboard.php';

if (!function_exists('canadian_digital_service_setup')) {
    function canadian_digital_service_setup()
    {
        load_theme_textdomain('canadian-digital-service', get_template_directory().'/languages');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('disable-custom-colors');
        add_theme_support('disable-custom-gradients');
        add_theme_support('editor-gradient-presets', []);

        add_theme_support('editor-color-palette', [
            [
                'name' => __('Blue', 'canadian-digital-service'),
                'slug' => 'blue',
                'color' => '#26374A',
            ],
            [
                'name' => __('White', 'canadian-digital-service'),
                'slug' => 'white',
                'color' => '#FFF',
            ],
            [
                'name' => __('Red', 'canadian-digital-service'),
                'slug' => 'red',
                'color' => '#b10e1e',
            ],
            [
                'name' => __('Green', 'canadian-digital-service'),
                'slug' => 'green',
                'color' => '#00703C',
            ],
        ]);

        register_nav_menus([
            'primary' => esc_html__('Primary', 'canadian-digital-service'),
            'footer' => esc_html__('Footer', 'canadian-digital-service'),
        ]);
    }
}

add_action('after_setup_theme', 'canadian_digital_service_setup');

/**
 * Enqueue scripts and styles.
 */
function canadian_digital_service_scripts()
{
    wp_enqueue_script('cds-js', get_template_directory_uri().'/public/js/main.js', ['jquery'], '1.0.0', true);
    wp_register_style('cds-style', get_template_directory_uri().'/public/dist/main.css');
    wp_register_style('theme-style', get_template_directory_uri().'/public/css/theme.css');
    wp_enqueue_style('cds-style');
    wp_enqueue_style('theme-style');
}

add_action('wp_enqueue_scripts', 'canadian_digital_service_scripts');

/**
 * Path utils.
 *
 * @param mixed $image
 */
function get_image_directory($image)
{
    return get_template_directory_uri().'/public/img/'.$image;
}

function get_favicon($icon)
{
    return get_template_directory_uri().'/public/'.$icon;
}

function show_lang($lang)
{
    if ('french' == strtolower($lang)) {
        return 'Français';
    }

    return 'English';
}

function icl_post_languages()
{
    if (function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=1');
        if (1 < count($languages)) {
            foreach ($languages as $l) {
                if (!$l['active']) {
                    $langs[] = '<a href="'.$l['url'].'">'.show_lang($l['translated_name']).'</a>';
                }
            }
            echo join(', ', $langs);
        }
    }
}
