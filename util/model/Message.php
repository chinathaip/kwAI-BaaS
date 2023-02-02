<?php

class Message
{
    var $id = 0;
    var $history_id = 0;
    var $user_question = "";
    var $ai_response = "";

    function __construct(int $history_id, string $user_question, string $ai_response)
    {
        $this->history_id = $history_id;
        $this->user_question = $user_question;
        $this->ai_response = $ai_response;
    }
}