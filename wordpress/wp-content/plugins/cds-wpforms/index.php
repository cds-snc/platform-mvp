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
// require_once __DIR__ .'/inc/list-table-example.php';

function cds_wpforms_images_url($filename)
{
    return plugin_dir_url(__FILE__).'images/'.$filename;
}

function cds_wpforms_styles(): void
{
    wp_enqueue_style('cds_wpforms', plugin_dir_url(__FILE__).'css/main.css', [], 1);
}

function cds_wpforms_styles_js(): void
{
    wp_enqueue_script('cds_wpforms', plugins_url('js/main.js', __FILE__), ['jquery'], '1.0.0', true);
}

const CDS_DB_VERSION = 101;

function cds_alter_table():void{
    global $wpdb;


    $option_name = "CDS_WP_FORMS_TABLE_VERSION";
    echo $installed_ver = get_option($option_name);
    $wpp = $wpdb->prefix . "_wpforms";
    if ($installed_ver < 102) {
        $confirmed_result = $wpdb->query("ALTER TABLE ${wpp}_entries ADD COLUMN confirmed boolean");
        $subscription_id_result = $wpdb->query("ALTER TABLE ${wpp}_entries ADD COLUMN subscription_id varchar");
    }


    update_option($option_name, CDS_DB_VERSION);
}

function cds_wpforms_setup(): void
{
    cds_wpforms_styles();
    cds_wpforms_styles_js();
    cds_alter_table();
}

add_action('wp_enqueue_scripts', 'cds_wpforms_setup');
add_action('admin_enqueue_scripts', 'cds_wpforms_setup');
