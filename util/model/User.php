<?php

class User
{
    var $id = 0;
    var $username = "";
    var $password = "";

    function __construct($id, string $username, string $password) {
        $this ->id = $id;
        $this ->username = $username;
        $this ->password = $password;
    }
}