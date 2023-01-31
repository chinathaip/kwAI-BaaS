<?php

class history
{
    var $id = "";
    var $user_question = "";
    var $ai_response = "";

    function __construct($id, $user_question, $ai_response)
    {
        $this->id = $id;
        $this->user_question = $user_question;
        $this->ai_response = $ai_response;
    }
}