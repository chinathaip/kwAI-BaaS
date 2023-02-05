<?php

require_once 'Message.php';

class History
{
    var $id = 0;
    var $user_id = 0;
    var $name = "";

    function __construct($user_id, string $name)
    {
        $this->user_id = $user_id;
        $this->name = $name;
    }
}