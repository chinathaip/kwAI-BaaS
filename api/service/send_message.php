<?php
function send_messages(mysqli $db, Message $message, string $userid): Message
{
    if (!is_history_id_exist($db, $message->history_id)) {
        return new Message("history not exist", "", "");
    }
    if (!is_history_owner($db, $userid, $message->history_id)) {
        return new Message("not owner", "", "");
    }

    $stmt = $db->prepare("insert into messages (user_question, ai_response, history_id) values (?, ?, ?)");
    $stmt->bind_param("ssi", $message->user_question, $message->ai_response, $message->history_id);
    $stmt->execute();
    $message->id = $db->insert_id;
    return $message;
}