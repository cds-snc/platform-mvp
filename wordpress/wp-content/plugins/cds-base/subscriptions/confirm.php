<?php

use NotifyMailer\CDS\NotifyMailer;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../email/mailer.php';

function send_confirmation_email($data)
{
    global $wpdb;
    $notifyMailer = new NotifyMailer();

    // Validate the request contains email and form_id
    if ($errors = validateRequest($data)) {
        $response = new WP_REST_Response([
            'errors' => $errors
        ]);

        $response->set_status(400);
        return $response;
    }

    $email = $data['email'];
    $form_id = $data['form_id'];
    $subscription_id = Uuid::uuid1()->toString();
    $confirm_link = "http://localhost/lists/confirm/{$subscription_id}";
    $notifyTemplateId = "dc61faaf-2ee5-4392-bc98-bb08ad75b4c7";

    // Add a subscription_id to the entry for future use
    $result = $wpdb->query(
        $wpdb->prepare(
            "
                UPDATE {$wpdb->prefix}wpforms_entries
                SET subscription_id = %s
                WHERE JSON_SEARCH(fields, 'one', %s)
                AND form_id = %s
                AND confirmed IS NULL
            ",
            $subscription_id,
            $email,
            $form_id
        )
    );

    if($result) {
        // Send the confirmation email
        $notifyMailer->sendMail($email, $notifyTemplateId, [
            'list_name' => 'The List',
            'confirm_link' => $confirm_link
        ]);

        return new WP_REST_Response([
            'status' => 'success',
            'message' => 'Confirmation email sent'
        ]);
    }

    return new WP_REST_Response([
        'status' => 'Not found'
    ]);
}

function confirm_subscription($data)
{
    global $wpdb;

    $result = $wpdb->query(
        $wpdb->prepare(
            "
                UPDATE {$wpdb->prefix}wpforms_entries 
                SET confirmed = 1
                WHERE subscription_id = %s
            ",
            $data['subscription_id']
        )
    );

    if($result) {
        $response = new WP_REST_Response([
            'status' => 'confirmed'
        ]);

        return $response;
    }

    $response = new WP_REST_Response([
        'status' => 'Not found or already confirmed'
    ]);

    $response->set_status(400);

    return $response;
}

/*
 * Validate the request
 */
function validateRequest($data)
{
    $errors = [];

    if (!isset($data['email'])) {
        array_push($errors, 'Email required');
    }

    if (!isset($data['form_id'])) {
        array_push($errors, 'Form ID required');
    }

    return $errors;
}

add_action('rest_api_init', function () {
    // POST /lists/confirm
    register_rest_route('lists', '/confirm', [
        'methods' => 'POST',
        'callback' => 'send_confirmation_email'
    ]);

    // GET /lists/confirm/{subscription_id}
    register_rest_route('lists', '/confirm/(?P<subscription_id>[^/]+)', [
        'methods' => 'GET',
        'callback' => 'confirm_subscription',
    ]);
});