<?php

require_once 'Message.php';

class History
{
    var $history_id = 0;
    var $user_id = 0;
    var $name = "";

    function __construct(int $user_id, string $name)
    {
        $this->user_id = $user_id;
        $this->name = $name;
    }
}