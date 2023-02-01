<?php
function url_for($script_path): string
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function connectDB(): mysqli
{
    $conn = new mysqli("containers-us-west-187.railway.app", "root", "kuClq9pNEbhqXbFTP2CG", "railway", "6502");
    if ($conn->connect_error) {
        http_response_code(HTTP_INTERNAL_SERVER_ERROR);
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

function handle(string $method, callable $callback): void
{
    if ($_SERVER['REQUEST_METHOD'] == $method) {
        header("Content-Type: application/json");
        $db = connectDB();
        $callback($db);
        $db->close();
        exit();
    } else {
        http_response_code(HTTP_METHOD_NOT_ALLOWED);
    }
}


function is_history_id_exist(mysqli $db, string $hid): bool
{
    $result = $db->query("select id from history where history.id = " . $hid);
    $row = mysqli_fetch_assoc($result);
    if ($row == null) {
        return false;
    }
    return $row['id'] == (int)$hid;
}

function is_history_owner(mysqli $db, string $uid, string $hid): bool
{
    $result = $db->query("select id from history where user_id = " . $uid);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row['id'];
    }
    //check if history_id is in the array
    foreach ($rows as $id) {
        if ($id == $hid) {
            return true;
        }
    }
    return false;
}