<?php
require '../util/initialize.php';
require 'service/verify_login.php';
ini_set('display_errors', 1);

handle("POST", function (mysqli $db) {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'] ?? "";
    $password = $data['password'] ?? "";

    if ($username == "" || $password == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $result = verify_login($db, $username, $password);
    echo json_encode($result);
});


