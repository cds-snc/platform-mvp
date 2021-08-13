<?php
// Redirects all requests to the platform.cdssandbox.xyz.  
// Primarily used to redirect preview links from WP Admin


global $wp;
$host = $_SERVER['HTTP_HOST'];
$redirectHost = "platform.cdssandbox.xyz";
$homeUrl = home_url( $wp->request );

$search = array($host, 'http://');
$replace = array($redirectHost, 'https://');

$redirectUrl = str_replace($search, $replace, $homeUrl);

header("Location: $redirectUrl");