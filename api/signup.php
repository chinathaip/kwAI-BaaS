<?php
ini_set('display_errors', 1);
require dirname(__FILE__) . "/.." . "/util/initialize.php";

handle("POST", function (mysqli $db) {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'] ?? "";
    $hashPw = password_hash($data['password'] ?? "", PASSWORD_DEFAULT);


});
