<?php

declare(strict_types=1);

/**
 * Plugin Name: CDS-SNC Block - Alert
 * Plugin URI: https://github.com/cds-snc/platform-mvp
 * Description: Alert block plugin
 * Version: 1.0.0
 * Author: Tim Arney
 *
 * @package cds-snc-blocks
 */

defined('ABSPATH') || exit;

/**
 * Load all translations for our plugin from the MO file.
 */
add_action('init', 'cds_alert_textdomain');

function cds_alert_textdomain(): void
{
    load_plugin_textdomain('cds-snc-alert', false, basename(__DIR__) . '/languages');
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function cds_alert_register_block(): void
{

    // automatically load dependencies and version
    $asset_file = include plugin_dir_path(__FILE__) . 'build/index.asset.php';

    wp_register_script(
        'cds-snc-alert',
        plugins_url('build/index.js', __FILE__),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type('cds-snc/alert', [
        'editor_script' => 'cds-snc-alert',
    ]);

    if (function_exists('wp_set_script_translations')) {
        /**
         * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
         * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
         * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
         */
        wp_set_script_translations('cds-snc-alert', 'alert');
    }
}

function cds_alert_gutenberg_css(): void
{
    add_theme_support('editor-styles'); // if you don't add this line, your stylesheet won't be added

    add_editor_style(plugins_url('style-editor.css', __FILE__)); // tries to include style-editor.css directly from your theme folder
}

add_action('init', 'cds_alert_register_block');
add_action('after_setup_theme', 'cds_alert_gutenberg_css');
