<?php

namespace Tests;

use BadChoice\Handesk\Handesk;
use BadChoice\Handesk\Lead;
use PHPUnit\Framework\TestCase as BaseTestCase;

class LeadTest extends BaseTestCase{

    /** @test */
    public function can_create_a_lead(){
        Handesk::setup("http://handesk.test/api",'the-api-token');

        $id = (new Lead)->create([
            "email"       => "bruce@wayne.com",
            "body"        => "I'm interested in buying this awesome app",
            "username"    => "brucewayne",
            "name"        => "Bruce Wayne",
            "phone"       => "0044 456 567 54",
            "address"     => "Wayne manner",
            "city"        => "Gotham",
            "postal_code" => "90872",
            "company"     => "Wayne enterprises"]
            ,
            ["lightning","handesk"]
        );
        $this->assertTrue( is_numeric( $id ));
    }
}
