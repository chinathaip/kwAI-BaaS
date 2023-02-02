<?php

require_once 'Message.php';

class History
{
    var $history_id = 0;
    var $user_id = 0;

    function __construct(int $user_id)
    {
        $this->user_id = $user_id;
    }
}