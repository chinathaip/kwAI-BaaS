<?php
function create_new_history(mysqli $db, History $history): History
{
    $stmt = $db->prepare("insert into history (user_id, name) values (?,?)");
    $stmt->bind_param("is", $history->user_id, $history->name);
    $stmt->execute();
    $history->history_id = $db->insert_id;
    return $history;
}