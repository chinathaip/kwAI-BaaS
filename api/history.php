<?php
ini_set('display_errors', 1);
require '../util/initialize.php';
require '../util/model/History.php';
require 'service/get_history_by_id.php';
require 'service/create_new_history.php';

proceed("GET", function (mysqli $db) {
    $userid = $_GET['userid'] ?? "";
    $hid = $_GET['hid'] ?? "";
    if ($hid == "" || $userid == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $result = get_history_by_id($db, $userid, $hid); //TODO: add uid into argument
    switch ($result) {
        case count($result) == 0:
            http_response_code(HTTP_NOT_FOUND);
            exit();
        case in_array("not owner", $result):
            http_response_code(HTTP_FORBIDDEN);
            exit();
        default:
            http_response_code(HTTP_OK);
            echo json_encode($result);
            exit();
    }
});

proceed("POST", function (mysqli $db) {
    //read request body & put into History object
    $data = json_decode(file_get_contents('php://input'), true);
    $history = new History($data['history_id'], $data['user_id'], $data['messages']);
    if (!$history->is_valid()) {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $result = create_new_history($db, $history);
    http_response_code(HTTP_CREATED);
    echo json_encode($result);
});