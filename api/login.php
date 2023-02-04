<?php
ini_set('display_errors', 1);
require dirname(__FILE__) . "/.." . "/util/initialize.php";
require 'service/verify_login.php';

handle("POST", function (mysqli $db) {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'] ?? "";
    $hashPw = password_hash($data['password'] ?? "", PASSWORD_DEFAULT);
    if ($username == "" || $hashPw == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $result = get_credentials($db, $username);
    if (count($result) == 0) {
        http_response_code(HTTP_NOT_FOUND);
        exit();
    }

    if (password_verify($data['password'], $result['password'])) {
        http_response_code(HTTP_OK);
        echo json_encode($result);
    } else {
        http_response_code(HTTP_UNAUTHORIZED);
        exit();
    }
});


