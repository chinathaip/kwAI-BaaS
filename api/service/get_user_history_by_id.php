<?php
function get_user_history_by_id(mysqli $db, string $userid, string $hid): array
{
    if (!is_history_owner($db, $userid, $hid)) {
        return array("not owner");
    }

    $result = $db->query("select * from messages where history_id = " . $hid);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    return $arr;
}