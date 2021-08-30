<?php

use NotifyMailer\CDS\NotifyMailer;

require_once __DIR__ . '/../email/mailer.php';

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