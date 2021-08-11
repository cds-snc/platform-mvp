<?php

function wc_orders_dashboard_widgets()
{
    wp_add_dashboard_widget(
        'cds_widget_id',         // Widget slug.
                'Writing guide',         // Title.
                'wc_orders_dashboard_widget_function' // Display function.
    );
}

    add_action('wp_dashboard_setup', 'wc_orders_dashboard_widgets');

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function wc_orders_dashboard_widget_function()
{
    echo '<p>Your guide to writing solid content ... more text here<p>';
}
