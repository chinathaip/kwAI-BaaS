<?php

function get_credentials(mysqli $db, string $username): array
{
    $result = $db->query("select * from users where username = '" . $username . "'");
    if($row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return array();
}
