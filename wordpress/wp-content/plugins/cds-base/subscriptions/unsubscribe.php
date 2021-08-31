<?php

function cds_subscriptions_do_unsubscribe($subscription_id): bool
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

function cds_subscriptions_unsubscribe($data): WP_REST_Response
{
    $subscription_id = $data['subscription_id'];

    if(cds_subscriptions_do_unsubscribe($subscription_id)) {
        $response = new WP_REST_Response( [
            'status' => 'Success',
        ] );

        $response->set_status( 200 );

        return $response;
    }

    $response = new WP_REST_Response( [
        'status' => 'Not found'
    ]);

    $response->set_status(404);

    return $response;
}

function cds_subscriptions_unsubscribe_by_email($data): WP_REST_Response
{
    $email = $data['email'];

    // validate params
    // get subscription id by email/form_id
    // do_unsubscribe(subscription_id)

    $response = new WP_REST_Response( [
        'status' => 'Not found'
    ]);

    $response->set_status(404);

    return $response;
}

add_action('rest_api_init', function () {
    /*
     * GET /lists/unsubscribe/{subscription_id}
     */
    register_rest_route('lists', '/unsubscribe/(?P<subscription_id>[^/]+)', [
        'methods' => 'GET',
        'callback' => 'cds_subscriptions_unsubscribe',
    ]);

    /*
     * POST /lists/unsubscribe
     * Params: email, form_id
     */
    register_rest_route('lists', '/unsubscribe', [
        'methods' => 'POST',
        'callback' => 'cds_subscriptions_unsubscribe_by_email',
    ]);
});