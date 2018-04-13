<?php

namespace Tests;

use BadChoice\Handesk\Team;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TeamTest extends BaseTestCase{
    
     /** @test */
      public function can_get_team_open_tickets()
      {
          $tickets = (new Team(1))->tickets();
          $this->assertCount(2, $tickets);
      }

    /** @test */
    public function can_get_count_team_open_tickets()
    {
        $count = (new Team(1))->ticketsCount();
        $this->assertEquals(2, $count);
    }
}