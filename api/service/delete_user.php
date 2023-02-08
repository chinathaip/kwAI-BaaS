<?php

function delete_user(mysqli $db, string $uid): bool
{
    $db->query("delete from users where id = " . $uid);
    return true;
}
