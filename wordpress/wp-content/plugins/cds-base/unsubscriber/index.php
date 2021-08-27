<?php

function get_unsubscribe($data)
{
    // return new WP_Error('no_author', 'Invalid author', ['status' => 404]);
    $data = ['unsubscribed'];
    // $response = new WP_REST_Response($data);
    return $data;
}

function post_unsubscribe($data)
{
    global $wpdb;

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "
                DELETE from {$wpdb->prefix}wpforms_entries
                WHERE JSON_SEARCH(fields, 'one', %s)
            ",
            $data['email'],
        ),
    );

    return [
        'email' => $data['email'],
    ];
}

add_action('rest_api_init', function () {
    register_rest_route('lists/v1', '/unsubscribe', [
        'methods' => 'GET',
        'callback' => 'get_unsubscribe',
    ]);

    register_rest_route('lists/v1', '/unsubscribe', [
        'methods' => 'POST',
        'callback' => 'post_unsubscribe',
    ]);
});
