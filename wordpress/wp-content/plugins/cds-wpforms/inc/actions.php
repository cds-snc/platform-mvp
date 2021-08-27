<?php
function wpf_dev_display_submit_before($form_data)
{
    _e('<div class="form-group submit">', 'cds-snc');
}

add_action('wpforms_display_submit_before', 'wpf_dev_display_submit_before', 10, 1);

function wpf_dev_display_submit_after($form_data)
{
    _e('</div>', 'cds-snc');
}

add_action('wpforms_display_submit_after', 'wpf_dev_display_submit_after', 10, 1);
