<?php
function create_new_history(mysqli $db, History $history): History
{
    $db->query("insert into history (user_id) values ($history->user_id)");
    $history->history_id = $db->insert_id;
    return $history;
}