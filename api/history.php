<?php
ini_set('display_errors', 1);
require '../util/initialize.php';
require '../util/model/History.php';
require 'service/get_user_history_by_id.php';
require 'service/create_new_history.php';
require 'service/get_all_user_history.php';
require 'service/delete_history.php';

proceed("GET", function (mysqli $db) {
    $userid = $_GET['userid'] ?? "";
    $hid = $_GET['hid'] ?? "";
    if ($userid == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    //doesn't specify history id --> get all
    if ($hid == "") {
        $result = get_all_user_history($db, $userid);
        count($result) > 0 ? http_response_code(HTTP_OK) : http_response_code(HTTP_NOT_FOUND);
        echo json_encode($result);
        exit();
    }

    $result = get_user_history_by_id($db, $userid, $hid); //TODO: add uid into argument
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

proceed("DELETE", function (mysqli $db) {
    $userid = $_GET['userid'] ?? "";
    $hid = $_GET['hid'] ?? "";
    if ($userid == "" || $hid == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $isDeleted = delete_history($db, $userid, $hid);
    $isDeleted ? http_response_code(HTTP_OK) : http_response_code(HTTP_FORBIDDEN);
    echo json_encode(["status" => $isDeleted ? "deleted" : "error"]);
});