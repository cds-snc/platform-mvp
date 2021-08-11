<?php

function super_admin()
{
    return is_super_admin();
}

/*
$newusername = '';
$newpassword = '';
$newemail = '';

if (' ' != $newpassword && ' ' != $newemail && ' ' != $newusername) {
    if (!username_exists($newusername) && !email_exists($newemail)) {
        $user_id = wp_create_user($newusername, $newpassword, $newemail);
        if (is_int($user_id)) {
            $wp_user_object = new WP_User($user_id);
            $wp_user_object->set_role('administrator');

            grant_super_admin($user_id); // Grants Super Admin privileges.

            echo 'Successfully created new admin user.';
        } else {
            echo 'Error with wp_insert_user. No users were created.';
        }
    } else {
        echo 'This user or email already exists. Nothing was done.';
    }
} else {
    echo "Whoops, looks like you didn't set a password, username, or 
      email before running the script. Set these variables and try again.";
}
*/
