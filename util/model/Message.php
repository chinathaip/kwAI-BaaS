<?php

class Message
{
    var $id = "";
    var $user_question = "";
    var $ai_response = "";

    function __construct(string $user_question, string $ai_response)
    {
        $this->user_question = $user_question;
        $this->ai_response = $ai_response;
    }
}