<?php
function cds_dashboard_widget() {
    wp_add_dashboard_widget( 'cds_welcome_widget', __( 'Welcome', 'cds' ), 'cds_text_handler');
}

function cds_text_handler() {
    _e( '<a href=/wp-admin/post-new.php#">Create Article</a>', 'cds' );
}

add_action( 'wp_dashboard_setup', 'cds_dashboard_widget' );