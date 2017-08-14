<?php

namespace BadChoice\Handesk;

use GuzzleHttp\Client;

class Lead extends Handesk{

    public function create( $params, $tags ){
        $response = (new Client())->request("POST", static::$url . "/leads", [
            "headers"       => ["token" => static::$apiToken],
            "form_params"   => array_merge($params, ["tags" => $tags])
        ]);
        return json_decode($response->getBody())->data->id;
    }
}