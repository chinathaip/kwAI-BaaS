<?php
ini_set('display_errors', 1);
require dirname(__FILE__) . "/.." . "/util/initialize.php";
require_once BASE_DIR . '/util/model/History.php';
require_once BASE_DIR . '/util/model/Message.php';
require_once 'service/send_message.php';
require_once 'service/get_user_history_by_id.php';

handle("GET", function (mysqli $db) {
    $userid = cleanInput($_GET['userid'] ?? "");
    $hid = cleanInput($_GET['hid'] ?? "");
    if ($userid == "" || $hid == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    switch ($result = get_user_history_by_id($db, $userid, $hid)) {
        case in_array("history not exist", $result):
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

handle("POST", function (mysqli $db) {
    //read request body & put into History object
    $data = json_decode(file_get_contents('php://input'), true);
    $uid = cleanInput($data['user_id'] ?? "");
    $hid = cleanInput($data['history_id'] ?? "");
    $uq = cleanInput($data['user_question'] ?? "");
    $ai = cleanInput($data['ai_response'] ?? "");
    if ($uid == "" || $hid == "" || $uq == "" || $ai == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }
    $message = new Message($hid, $uq, $ai);

    switch ($result = send_messages($db, $message, $uid)) {
        case $result->history_id == "history not exist":
            http_response_code(HTTP_NOT_FOUND);
            exit();
        case $result->history_id == "not owner":
            http_response_code(HTTP_FORBIDDEN);
            exit();
        default:
            http_response_code(HTTP_CREATED);
            echo json_encode($result);
    }
});