<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight request
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit;
}

define('BASE_DIR', dirname(__FILE__) . "/..");

require_once 'utils.php';
require_once 'status.php';