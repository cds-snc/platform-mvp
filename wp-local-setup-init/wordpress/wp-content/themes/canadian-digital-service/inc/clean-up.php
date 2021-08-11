<?php

add_action('admin_menu', 'my_remove_menu_pages', 500);

function my_remove_menu_pages()
{
    global $inc;
    require_once $inc.'check-user.php';

    if (super_admin()) {
        return;
    }

    global $menu, $submenu;

    unset($submenu['gf_edit_forms'][3],
           $submenu['gf_edit_forms'][4],
           $submenu['gf_edit_forms'][5],
           $submenu['gf_edit_forms'][6],
           $submenu['gf_edit_forms'][7]
    );

    $allowed = [__('Pages'), __('Custom')];

    //  __('Settings'), __('Appearance')
    // http://localhost/cds/wp-admin/options-reading.php
    end($menu);
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (!in_array(null != $value[0] ? $value[0] : '', $allowed)) {
            unset($menu[key($menu)]);
        }
    }
}

add_action('admin_head', 'custom_styles');

function custom_styles()
{
    global $inc;
    require_once $inc.'check-user.php';

    if (super_admin()) {
        return;
    }

    $img = get_bloginfo('stylesheet_directory').'/public/img/cds-logo-en-fr-short.png';
    printf('<style>
    
    #wpcontent{
        margin-top:-30px;
    }

    #wp-admin-bar-wp-logo{
      display:none;
    }

    #wpfooter{
      display:none;
    }

    #wpadminbar{
      display:none;
      height:0;
    }

    #screen-meta-links{
        display:none;
    }

    #adminmenu::before {
        display:block;
        content:" ";
        background-image: url("%s");
        background-repeat:no-repeat;
        background-size:cover;
        width:50px;
        height:50px;
        margin-left:10px;
        margin-bottom:10px;
    }

    #no-fields{
      display:none;
    }

  </style>', $img, $img);
}

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
}

add_action('admin_init', 'remove_dashboard_meta');

function admin_enqueue($hook)
{
    wp_enqueue_script('cds-editor', get_stylesheet_directory_uri().'/public/js/editor.js', [], '1.0');
}

add_action('admin_enqueue_scripts', 'admin_enqueue');

/**
 * Gutenburg cleanup.
 */
function block_style()
{
    // Register the block editor script.
    wp_register_script(
        'editor-js',
        get_stylesheet_directory_uri().'/public/js/editor.js',
        ['wp-blocks', 'wp-edit-post']
    );

    // register block editor script.
    register_block_type('remove/block-style', [
        'editor_script' => 'editor-js',
    ]);
}

add_action('init', 'block_style');

add_filter('allowed_block_types', 'cds_allowed_block_types');

function cds_allowed_block_types($allowed_blocks)
{
    global $inc;
    require_once $inc.'check-user.php';

    if (super_admin()) {
        return $allowed_blocks;
    }

    // define what blocks we'll allow
    // wp.blocks.getBlockTypes()
    return [
        'core/image',
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/html',
        'core/code',
        'core/buttons',
        'gravityforms/form',
        'cds/callout-block',
        'cds/start-page',
    ];
}
