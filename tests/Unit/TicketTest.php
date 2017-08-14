<?php

namespace Tests;

use BadChoice\Handesk\Handesk;
use BadChoice\Handesk\Lead;
use BadChoice\Handesk\Ticket;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TicketTest extends BaseTestCase{

    /** @test */
    public function getting_ticket_for_unexisting_requester_returns_empty_list(){
        Handesk::setup("http://handesk.dev/api",'the-api-token');

        $tickets = (new Ticket)->get('non-existing-requester');

        $this->assertCount(0, $tickets);
    }

    /** @test */
    public function can_get_tickets_from_requester_with_name(){
        Handesk::setup("http://handesk.dev/api",'the-api-token');

        $tickets = (new Ticket)->get('Bruce Wayne');

        $this->assertTrue(count($tickets) > 0);
    }

    /** @test */
    public function can_get_tickets_from_requester_with_email(){
        Handesk::setup("http://handesk.dev/api",'the-api-token');

        $tickets = (new Ticket)->get('bruce@wayne.com');

        $this->assertTrue(count($tickets) > 0);
    }

    /** @test */
    public function can_create_and_fetch_ticket(){
        $id = (new Ticket)->create(["name" => "Bruce Wayne", "email" => "bruce@wayne.com"], "I have a big problem", "I hope you can help me", ["backend","crash"]);

        $this->assertTrue( is_numeric($id) );

        $ticket = (new Ticket)->find($id);
        $this->assertEquals("Bruce Wayne",              $ticket->requester->name);
        $this->assertEquals("bruce@wayne.com",          $ticket->requester->email);
        $this->assertCount(1, $ticket->comments);
        $this->assertEquals("I have a big problem",     $ticket->title);
        $this->assertEquals("I hope you can help me",   $ticket->body);
        $this->assertEquals("I hope you can help me",   $ticket->comments[0]->body);
        $this->assertEquals(Ticket::STATUS_NEW,         $ticket->status);

        $ticket->addComment("This is my comment", false);
        $ticket = (new Ticket)->find($id);
        $this->assertCount(2, $ticket->comments);
        $this->assertEquals("This is my comment", $ticket->comments[0]->body);
        $this->assertEquals(Ticket::STATUS_NEW,         $ticket->status);

        $ticket->addComment("Solving it", true);
        $ticket = (new Ticket)->find($id);
        $this->assertCount(3, $ticket->comments);
        $this->assertEquals(Ticket::STATUS_SOLVED,         $ticket->status);
    }
}
