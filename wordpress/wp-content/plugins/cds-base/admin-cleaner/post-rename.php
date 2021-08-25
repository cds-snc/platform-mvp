<?php
function cds_change_post_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = _('Articles', 'cds');
    $submenu['edit.php'][5][0] = _('Articles', 'cds');
    $submenu['edit.php'][10][0] = _('Add Article', 'cds');
    $submenu['edit.php'][16][0] = _('Article Tags', 'cds');
}

function cds_change_post_object()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = _('Articles', 'cds');
    $labels->singular_name = _('Articles', 'cds');
    $labels->add_new = _('Add Articles', 'cds');
    $labels->add_new_item = _('Add Articles', 'cds');
    $labels->edit_item = _('Edit Articles', 'cds');
    $labels->new_item = _('Articles', 'cds');
    $labels->view_item = _('View Articles', 'cds');
    $labels->search_items = _('Search Articles', 'cds');
    $labels->not_found = _('No Articles found', 'cds');
    $labels->not_found_in_trash = _('No Articles found in Trash', 'cds');
    $labels->all_items = _('All Articles', 'cds');
    $labels->menu_name = _('Articles', 'cds');
    $labels->name_admin_bar = _('Articles', 'cds');
}

add_action('admin_menu', 'cds_change_post_label');
add_action('init', 'cds_change_post_object');
