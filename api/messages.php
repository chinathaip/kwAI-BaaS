<?php
ini_set('display_errors', 1);
require dirname(__FILE__) . "/.." . "/util/initialize.php";
require_once BASE_DIR . '/util/model/History.php';
require_once BASE_DIR . '/util/model/Message.php';
require_once 'service/send_message.php';

handle("POST", function (mysqli $db) {
    //read request body & put into History object
    $data = json_decode(file_get_contents('php://input'), true);
    $uid = $data['user_id'] ?? "";
    $hid = $data['history_id'] ?? "";
    $uq = $data['user_queue'] ?? "";
    $ai = $data['ai_response'] ?? "";
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