<?php
function get_all_user_history(mysqli $db, string $userid): array
{
    $list_of_hids = get_ids($db, $userid);
    $arr = array();
    foreach ($list_of_hids as $hid) {
        $result = get_user_history_by_id($db, $userid, $hid);
        $arr = array_merge($arr, $result);
    }
    return $arr;
}

function get_ids(mysqli $db, string $userid): array
{
    $result = $db->query("select id from history where user_id = " . $userid);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row['id'];
    }
    return $arr;
}
