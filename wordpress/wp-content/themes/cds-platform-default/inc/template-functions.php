<?php
/**
 * Custom template pagination
 *
 */


//loadmore
function wpsites_query( $query ) {
if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 8 );
        $query->set( 'order', 'DESC' );
        $query->set( 'post_status', 'publish' );
        
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );

add_action('wp_ajax_platform_loadmore', 'platform_loadmore'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_platform_loadmore', 'platform_loadmore'); // wp_ajax_nopriv_{action}

function platform_loadmore() {
  
  // prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
  $args['posts_per_page'] = 8;
  
  // it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();    
    
			?><div class="col-md-4 col-lg-3">
        <?php get_template_part( 'template-parts/content/content-card', get_post_type() ); ?>
      </div><?php
 
 
		endwhile;
 
	endif;
  exit;
}
