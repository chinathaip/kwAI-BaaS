<?php

function get_all_history(mysqli $db, string $userid): array
{
    $result = $db->query("select * from history where user_id = " . $userid);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    return $arr;

}
