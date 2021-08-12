<?php
/** 
 * Plugin Name: CDS-SNC Table Styles
 * Plugin URI: https://github.com/cds-snc/platform-mvp
 * Description: Adds additional styles to table options within the WP Admin
 * Version: 1.1.0
 * Author: Tim Arney
 *
 * @package cds-snc-table-styles
 */

defined( 'ABSPATH' ) || exit;

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






