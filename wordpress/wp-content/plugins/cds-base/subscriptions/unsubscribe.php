<?php

function do_unsubscribe($subscription_id)
{
    global $wpdb;

    $count = $wpdb->query(
        $wpdb->prepare(
            "
                DELETE from {$wpdb->prefix}wpforms_entries
                WHERE subscription_id = %s
            ",
            $subscription_id,
        ),
    );

    return $count > 0;
}

function unsubscribe($data)
{
    $subscription_id = $data['subscription_id'];

    if(do_unsubscribe($subscription_id)) {
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

function unsubscribe_by_email($data)
{
    $email = $data['email'];

    // validate params
    // get subscription id by email/form_id
    // do_unsubscribe(subscription_id)
}

add_action('rest_api_init', function () {
    /*
     * GET /lists/unsubscribe/{subscription_id}
     */
    register_rest_route('lists', '/unsubscribe/(?P<subscription_id>[^/]+)', [
        'methods' => 'GET',
        'callback' => 'unsubscribe',
    ]);

    /*
     * POST /lists/unsubscribe
     * Params: email, form_id
     */
    register_rest_route('lists', '/unsubscribe', [
        'methods' => 'POST',
        'callback' => 'unsubscribe_by_email',
    ]);
});