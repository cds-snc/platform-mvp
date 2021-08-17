<?php

/**
 * Plugin Name: CDS-SNC Base
 * Plugin URI: https://github.com/cds-snc/platform-mvp
 * Description: Custom Block setup and other overrides
 * Version: 1.0.0
 * Author: Tim Arney
 *
 * @package cds-snc-base
 */

defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
*/
add_action( 'init', 'cds_textdomain' );

function cds_textdomain() {
	load_plugin_textdomain( 'cds-snc', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function cds_register_block() {

	// automatically load dependencies and version
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

	wp_register_script(
		'cds-snc',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);

	/* blocks */

	register_block_type( 'cds-snc/expander', array(
		'editor_script' => 'cds-snc',
	) );

	register_block_type( 'cds-snc/alert', array(
		'editor_script' => 'cds-snc',
	) );

	/* table styles */
	register_block_style(
		'core/table',
		array(
			'name'  => 'bordered-table',
			'label' => 'Bordered Table',
		)
	  );
	  
	  register_block_style(
		'core/table',
		array(
			'name'  => 'filterable',
			'label' => 'Filterable Table',
		)
	  );
	  
	  register_block_style(
		'core/table',
		array(
			'name'  => 'responsive-cards',
			'label' => 'Responsive Cards Table',
		)
	  );





  if ( function_exists( 'wp_set_script_translations' ) ) {
    /**
     * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
     * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
     * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
     */
    wp_set_script_translations( 'cds-snc-base', 'cds-snc' );
  }

}
add_action( 'init', 'cds_register_block' );