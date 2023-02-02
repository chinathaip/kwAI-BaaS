<?php

class Message
{
    var $id = "";
    var $history_id = "";
    var $user_question = "";
    var $ai_response = "";

    function __construct(string $history_id, string $user_question, string $ai_response)
    {
        $this->history_id = $history_id;
        $this->user_question = $user_question;
        $this->ai_response = $ai_response;
    }
}