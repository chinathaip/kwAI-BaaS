<?php
function get_history_by_id(mysqli $db, string $id): array
{
    $result = $db->query("select id, user_question, ai_response from messages where messages.history_id = " . $id);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    return $arr;
}
