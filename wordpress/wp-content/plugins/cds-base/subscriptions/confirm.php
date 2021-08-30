<?php

use NotifyMailer\CDS\NotifyMailer;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../email/mailer.php';

function send_confirmation_email($data)
{
    global $wpdb;

    $errors = [];

    if (!isset($data['email'])) {
        array_push($errors, 'Email required');
    }

    if (!isset($data['form_id'])) {
        array_push($errors, 'Form ID required');
    }

    if(count($errors)) {
        $response = new WP_REST_Response( [
            'errors' => $errors
        ]);

        $response->set_status( 400 );
        return $response;
    }

    $notifyMailer = new NotifyMailer();
    $email = $data['email'];
    $form_id = $data['form_id'];
    $subscription_id = Uuid::uuid1()->toString();
    $confirm_link = "http://localhost/lists/confirm/{$subscription_id}";
    // $confirmed = false;

    $result = $wpdb->query(
        $wpdb->prepare(
            "
                UPDATE {$wpdb->prefix}wpforms_entries
                SET subscription_id = %s
                WHERE JSON_SEARCH(fields, 'one', %s)
                AND form_id = %s
            ",
            $subscription_id,
            $email,
            $form_id
        )
    );

    $templateId = "dc61faaf-2ee5-4392-bc98-bb08ad75b4c7";

    $notifyMailer->sendMail($email, $templateId, [
        'list_name' => 'The List',
        'confirm_link' => $confirm_link
    ]);

    return $result;
}

add_action('rest_api_init', function () {
    // POST /lists/confirm
    register_rest_route('lists', '/confirm', [
        'methods' => 'POST',
        'callback' => 'send_confirmation_email'
    ]);

    // GET /lists/confirm/{id}
});