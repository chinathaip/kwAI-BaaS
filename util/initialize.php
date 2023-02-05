<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight request
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit;
}

define('BASE_DIR', dirname(__FILE__) . "/..");
$admin_end = strpos($_SERVER['SCRIPT_NAME'], '/admin') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $admin_end);
define("WWW_ROOT", $doc_root);

require_once 'utils.php';
require_once 'status.php';