<?php

function do_unsubscribe($email)
{
    global $wpdb;

    $count = $wpdb->query(
        $wpdb->prepare(
            "
                DELETE from {$wpdb->prefix}wpforms_entries
                WHERE JSON_SEARCH(fields, 'one', %s)
            ",
            $email,
        ),
    );

    return $count > 0;
}

function unsubscribe($data)
{
    $email = $data['email'];

    if(do_unsubscribe($email)) {
        $response = new WP_REST_Response( [
            'email' => $data['email'],
            'action' => 'unsubscribed',
            'status' => 'success',
        ] );

        $response->set_status( 200 );

        return $response;
    }

    $response = new WP_REST_Response( [
        'status' => 'not found'
    ]);

    $response->set_status(404);

    return $response;
}