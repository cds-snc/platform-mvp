<?php

declare(strict_types=1);

/**
 * Plugin Name: CDS-SNC WP Forms
 * Plugin URI: -
 * Description: Adds custom styling for WPForms
 * Version: 1.0.1
 * Author: Tim Arney
 *
 * @package cds-snc-wpforms
 */

defined('ABSPATH') || exit;

const CDS_WP_FORMS_VERSION = "1.0.1";

require_once __DIR__ . '/inc/actions.php';
// require_once __DIR__ .'/inc/list-table-example.php';

function cds_wpforms_images_url($filename)
{
    return plugin_dir_url(__FILE__) . 'images/' . $filename;
}

function cds_wpforms_styles(): void
{
    wp_enqueue_style('cds_wpforms', plugin_dir_url(__FILE__) . 'css/main.css', [], 1);
}

function cds_wpforms_styles_js(): void
{
    wp_enqueue_script('cds_wpforms', plugins_url('js/main.js', __FILE__), ['jquery'], '1.0.0', true);
}

function cds_column_is_empty($table, $column): bool
{
    global $wpdb;
    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '${table}' AND column_name = '${column}'";
    $row = $wpdb->get_results($query);

    if (empty($row)) {
        return true;
    }

    return false;

}


function cds_alter_table(): void
{
    global $wpdb;
    $wpp = $wpdb->prefix . "wpforms";

    // add `confirmed` column if it doesn't exist
    $column = "confirmed";
    if (cds_column_is_empty($wpp . "_entries", $column)) {
        echo $wpdb->query("ALTER TABLE ${wpp}_entries ADD COLUMN ${column} boolean");
    }

    // add `subscription_id` if it doesn't exist
    $column = "subscription_id";
    if (cds_column_is_empty($wpp . "_entries", $column)) {
        $wpdb->query("ALTER TABLE ${wpp}_entries ADD COLUMN ${column} VARCHAR(255)");
    }
}

function cds_wpforms_setup(): void
{
    cds_wpforms_styles();
    cds_wpforms_styles_js();

}

add_action('wp_enqueue_scripts', 'cds_wpforms_setup');
add_action('plugins_loaded', 'cds_alter_table');
