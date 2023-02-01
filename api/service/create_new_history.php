<?php
function create_new_history(mysqli $db, History $history): History
{

    $db->query("insert into history (user_id) values ($history->user_id)");
    $history->history_id = $db->insert_id;
//    foreach ($history->messages as $message) {
    //if not exist, create new history
//        if (!is_history_id_exist($history->history_id, $db)) {
//            $db->query("insert into history (id, user_id) values ($history->history_id, $history->user_id)");
//        }

//        $stmt = $db->prepare("insert into messages (user_question, ai_response, history_id) values (?, ?, ?)");
//        $stmt->bind_param("ssi", $message->user_question, $message->ai_response, $history->history_id);
//        $stmt->execute();
//        $id = $db->insert_id;
//        $message->id = $id;
//    }
    return $history;
}