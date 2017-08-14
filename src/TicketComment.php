<?php

namespace BadChoice\Handesk;

class TicketComment extends Handesk {

    public $objects = ["author"];

    public function __construct(array $attributed = []) {
        parent::__construct($attributed);
    }

}