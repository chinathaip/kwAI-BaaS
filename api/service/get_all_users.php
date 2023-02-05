<?php


function get_all_users(mysqli $db): array
{
    $result = $db->query("select * from users");
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = new User($row['id'], $row['username'], $row['password']);
    }
    return $arr;
}