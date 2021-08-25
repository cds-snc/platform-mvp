<?php
/**
 * Remove notices
 **/
add_action('in_admin_header', function () {

    remove_all_actions('admin_notices');
    remove_all_actions('all_admin_notices');

    /*
    add_action('admin_notices', function () {
        echo 'My notice';
    });
    */
}, 1000);