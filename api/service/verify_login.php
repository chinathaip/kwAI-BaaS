<?php

function verify_login(mysqli $db, string $username, string $password): array
{
    $stmt = $db->prepare("select * from users where username = ? and password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $arr = array();
    while($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
    return $arr;
}
