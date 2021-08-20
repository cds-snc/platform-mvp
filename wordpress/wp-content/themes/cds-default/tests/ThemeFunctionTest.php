<?php

require __DIR__ . '/../../../../vendor/autoload.php';

// Now call the bootstrap method of WP Mock
WP_Mock::bootstrap();

require_once __DIR__.'/../inc/template-functions.php';



test('theme example', function () {

    

    
    
    WP_Mock::passthruFunction( 'get_permalink' );
    
    $prev_post = new \stdClass;
	$prev_post->ID = 42;
    $prev_post->post_title = "Post 1";
    $prev_post->guid = "https://example.com/page1";
    \WP_Mock::userFunction( 'get_previous_post', array($prev_post));

    $next_post = new \stdClass;
	$next_post->ID = 43;
    $next_post->post_title = "Post 2";
    $next_post->guid = "https://example.com/page2";
    \WP_Mock::userFunction( 'get_next_post', array($next_post));


    cds_prev_next_links();
    expect(true)->toBeTrue();
});
