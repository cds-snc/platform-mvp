<?php

namespace NotifyMailer\CDS;

class NotifyMailer
{

    public \Alphagov\Notifications\Client $notifyClient;

    public function __construct()
    {
        $this->notifyClient = $this->setupClient();
    }

    private function setupClient(): \Alphagov\Notifications\Client
    {
        $NOTIFY_API_KEY = $_ENV['NOTIFY_API_KEY'];
        return new \Alphagov\Notifications\Client([
            'baseUrl' => "https://api.notification.canada.ca",
            'apiKey' => $NOTIFY_API_KEY,
            'httpClient' => new \Http\Adapter\Guzzle6\Client
        ]);
    }

    public function sendMail($emailTo, $templateId, $data = [], $ref = "")
    {
        try {
            $response = $this->notifyClient->sendEmail(
                $emailTo,
                $templateId,
                $data,
                $ref
            );
        } catch (NotifyException $e) {
            echo $e->getMessage();
        }
    }
}