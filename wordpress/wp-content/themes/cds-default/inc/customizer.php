<?php

declare(strict_types=1);

/**
 * cds-default Theme Customizer
 *
 * @package cds-default
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cds_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            [
                'selector' => '.site-title a',
                'render_callback' => 'cds_customize_partial_blogname',
            ]
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            [
                'selector' => '.site-description',
                'render_callback' => 'cds_customize_partial_blogdescription',
            ]
        );
    }
}
add_action('customize_register', 'cds_customize_register');

/**
 * Render the site title for the selective refresh partial.
 */
function cds_customize_partial_blogname(): void
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function cds_customize_partial_blogdescription(): void
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cds_customize_preview_js(): void
{
    wp_enqueue_script('cds-customizer', get_template_directory_uri() . '/js/customizer.js', [ 'customize-preview' ], _S_VERSION, true);
}
add_action('customize_preview_init', 'cds_customize_preview_js');
