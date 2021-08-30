<?php

use NotifyMailer\CDS\NotifyMailer;

require_once __DIR__ . '/../email/mailer.php';

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

function send_confirmation_email($data)
{
    $notifyMailer = new NotifyMailer();

    $emailTo = $data['email'];
    $templateId = "dc61faaf-2ee5-4392-bc98-bb08ad75b4c7";

    $notifyMailer->sendMail($emailTo, $templateId, [
        'list_name' => 'The List',
        'confirm_link' => 'http://whatever.com'
    ]);
}

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
