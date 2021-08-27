<?php

declare(strict_types=1);

/**
 * Plugin Name: CDS-SNC WP Forms
 * Plugin URI: -
 * Description: Adds custom styling for WPForms
 * Version: 1.0.1
 * Author: Tim Arney
 *
 * @package cds-snc-base
 */

defined('ABSPATH') || exit;

require_once __DIR__ .'/inc/actions.php';

function cds_wpforms_images_url($filename)
{
    return plugin_dir_url(__FILE__).'images/'.$filename;
}

function cds_wpforms_styles(): void
{
    wp_enqueue_style('cds_wpforms', plugin_dir_url(__FILE__).'css/main.css', [], 1);
    wp_enqueue_style('cds_wpforms_post_23', plugin_dir_url(__FILE__).'css/post23.css', [], 1);
}

function cds_wpforms_styles_js(): void
{
    wp_enqueue_script('cds_wpforms', plugins_url('js/main.js', __FILE__), ['jquery'], '1.0.0', true);
}

function cds_wpforms_setup(){
    cds_wpforms_styles();
    cds_wpforms_styles_js();
}

add_action('wp_enqueue_scripts', 'cds_wpforms_setup');

