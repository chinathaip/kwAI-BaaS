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

function proceed(string $method, callable $yes): void
{
    if ($_SERVER['REQUEST_METHOD'] == $method) {
        header("Content-Type: application/json");
        $db = connectDB();
        $yes($db);
        $db->close();
        exit();
    } else {
        http_response_code(HTTP_METHOD_NOT_ALLOWED);
    }
}

function extract_path_param(): string
{
    $userid = "";
    $pattern = '/history\.php\/([^\/]+)/';
    if (preg_match($pattern, $_SERVER['REQUEST_URI'], $matches)) {
        $userid = $matches[1];
    }
    return $userid;
}