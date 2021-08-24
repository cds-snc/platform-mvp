<?php

function super_admin()
{
    return is_super_admin();
}

function hide_wp_mail_smtp_menus() {
    //Hide "WP Mail SMTP".
    remove_menu_page('wp-mail-smtp');
    //Hide "WP Mail SMTP → Settings".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp');
    //Hide "WP Mail SMTP → Email Log".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-logs');
    //Hide "WP Mail SMTP → Email Reports".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-reports');
    //Hide "WP Mail SMTP → Tools".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-tools');
    //Hide "WP Mail SMTP → About Us".
    remove_submenu_page('wp-mail-smtp', 'wp-mail-smtp-about');
}

function remove_menu_pages()
{
    
    if (super_admin()) {
        return;
    }
    
    global $menu, $submenu;

    $allowed = [__('Pages'), __('Posts')];

    //  __('Settings'), __('Appearance')
    // http://localhost/cds/wp-admin/options-reading.php
    end($menu);
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (!in_array(null != $value[0] ? $value[0] : '', $allowed)) {
            unset($menu[key($menu)]);
        }
    }

    hide_wp_mail_smtp_menus();


}

add_action('admin_menu', 'remove_menu_pages', 2147483647);

function remove_dashboard_meta()
{
    // remove for all users
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');
    remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal');
    remove_meta_box('task_dashboard', 'dashboard', 'normal');


}

add_action('admin_init', 'remove_dashboard_meta');


function remove_from_admin_bar($wp_admin_bar) {

    if (super_admin()) {
        return;
    }

    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('site-name');
    $wp_admin_bar->remove_menu('wpseo-menu');
    $wp_admin_bar->remove_menu('wp-mail-smtp-menu');
    $wp_admin_bar->remove_menu('WPML_ALS');
    $wp_admin_bar->remove_node('customize');
   
    /*
     * Items placed outside the if statement will remove it from both the frontend
     * and backend of the site
    */
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_from_admin_bar', 999);

add_filter( 'wp_mail_smtp_admin_adminbarmenu_has_access', '__return_false' );




