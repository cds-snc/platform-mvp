<?php
function my_admin_menu()
{
    add_menu_page(
        __('Sample page', 'my-textdomain'),
        __('Custom Menu', 'my-textdomain'),
        'manage_options',
        'sample-page',
        'my_admin_page_contents',
        'dashicons-schedule',
        100
    );
}

add_action('admin_menu', 'my_admin_menu');

function my_admin_page_contents()
{
    ?>
		<h1>
			<?php esc_html_e('Custom admin page goes here', 'my-plugin-textdomain'); ?>
		</h1>
	<?php
}
