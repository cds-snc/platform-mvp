<?php

require_once __DIR__ . '/unsubscribe.php';
require_once __DIR__ . '/confirm.php';

add_action('rest_api_init', function () {
    register_rest_route('lists', '/unsubscribe/(?P<email>[^/]+)', [
        'methods' => 'GET',
        'callback' => 'unsubscribe',
    ]);

    register_rest_route('lists', '/unsubscribe', [
        'methods' => 'POST',
        'callback' => 'unsubscribe',
    ]);

    register_rest_route('lists', '/confirm', [
        'methods' => 'POST',
        'callback' => 'send_confirmation_email'
    ]);
});