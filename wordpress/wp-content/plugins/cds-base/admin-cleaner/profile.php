<?php
function disable_user_profile()
{
    //wp_die('You are not allowed to edit the user profile.');
}

add_action('load-profile.php', 'disable_user_profile');