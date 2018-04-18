<?php

namespace BadChoice\Handesk;

use GuzzleHttp\Client;

class Team extends Handesk {

    public $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public static function create($name, $email, $slackWebhookUrl = null)
    {
        $response = (new Client())->request("POST", static::$url . "/teams", [
                "headers" => ["token" => static::$apiToken],
                'form_params' => [
                    'name' => $name,
                    'email' => $email,
                    'slack_webhook_url' => $slackWebhookUrl
                ]
            ]
        );

        return new Team(json_decode($response->getBody(), true)["data"]["id"]);
    }

    public function tickets($status = 'open')
    {
        try {
            $response = (new Client())->request("GET", static::$url . "/teams/{$this->id}/tickets?status={$status}", ["headers" => ["token" => static::$apiToken]]);
            return array_map(function ($attributes) {
                return new Ticket($attributes);
            }, json_decode($response->getBody(), true)["data"]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function ticketsCount($status = 'open') {
        try {
            $response = (new Client())->request("GET", static::$url . "/teams/{$this->id}/tickets?status={$status}&count=true", ["headers" => ["token" => static::$apiToken]]);
            return json_decode($response->getBody(), true)["data"]["count"];
        } catch (\Exception $e) {
            return 0;
        }
    }
}