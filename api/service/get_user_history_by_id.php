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

//function is_history_owner(mysqli $db, string $uid, string $hid): bool
//{
//    $result = $db->query("select id from history where user_id = " . $uid);
//    $rows = array();
//    while ($row = mysqli_fetch_assoc($result)) {
//        $rows[] = $row['id'];
//    }
//    //check if history_id is in the array
//    foreach ($rows as $id) {
//        if ($id == $hid) {
//            return true;
//        }
//    }
//    return false;
//}
