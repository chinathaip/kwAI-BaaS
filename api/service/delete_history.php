<?php

function delete_history(mysqli $db, string $userid, string $hid): bool
{
    if (!is_history_owner($db, $userid, $hid)) {
        return false;
    }
    $db->query("delete from history where id = " . $hid);
    return true;
}
