<?php

require_once 'Message.php';

class History
{
    var $history_id = "";
    var $user_id = "";
//    var $messages = array();

    function __construct(string $user_id)
    {
        $this->user_id = $user_id;
//        $this->extract_message($messages);
    }

    function is_valid(): bool
    {
//        foreach ($this->messages as $message) {
//            if ($message->user_question == "" || $message->ai_response == "") {
//                return false;
//            }
//        }
        return $this->user_id != ""; // && count($this->messages) > 0;
    }

//    private function extract_message(array $messages)
//    {
//        try {
//            foreach ($messages as $message) {
//                $this->messages[] = new Message(
//                    $message['user_question'],
//                    $message['ai_response']
//                );
//            }
//        } catch (TypeError|Throwable $e) {
//            //set empty array if something wrong
//            $this->messages = array();
//        }
//    }

}