<?php
function get_history_by_id(mysqli $db, string $userid, string $hid): array
{
    if (!is_history_owner($db, $userid, $hid)) {
        return array("not owner");
    }

    $result = $db->query("select id, user_question, ai_response from messages where history_id = " . $hid);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    return $arr;
}

function is_history_owner(mysqli $db, string $uid, string $hid): bool
{
    $result = $db->query("select * from history where history.user_id = " . $uid);
    $row = mysqli_fetch_assoc($result);
    if ($row == null) {
        return false;
    }

    return in_array($hid, $row);
}
