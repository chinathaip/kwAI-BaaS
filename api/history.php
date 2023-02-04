<?php
ini_set('display_errors', 1);
require dirname(__FILE__) . "/.." . "/util/initialize.php";
require_once BASE_DIR . '/util/model/History.php';
require_once 'service/create_new_history.php';
require_once 'service/delete_history.php';
require_once 'service/get_all_history.php';

handle("GET", function (mysqli $db) {
    $userid = $_GET['userid'] ?? "";
    if ($userid == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $result = get_all_history($db, $userid);
    if (count($result) == 0) {
        http_response_code(HTTP_NOT_FOUND);
        exit();
    }
    http_response_code(HTTP_OK);
    echo json_encode($result);
});

handle("POST", function (mysqli $db) {
    //read request body & put into History object
    $data = json_decode(file_get_contents('php://input'), true);
    $uid = $data['user_id'] ?? "";
    $hid = $data['history_name'] ?? "New Chat";
    if ($uid == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }
    $history = new History($uid, $hid);

    $result = create_new_history($db, $history);
    http_response_code(HTTP_CREATED);
    echo json_encode($result);
});

handle("DELETE", function (mysqli $db) {
    $data = json_decode(file_get_contents('php://input'), true);
    $userid = $data['user_id'] ?? "";
    $hid = $data['history_id'] ?? "";
    if ($userid == "" || $hid == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $isDeleted = delete_history($db, $userid, $hid);
    $isDeleted ? http_response_code(HTTP_OK) : http_response_code(HTTP_FORBIDDEN);
    echo json_encode(["status" => $isDeleted ? "deleted" : "error"]);
});