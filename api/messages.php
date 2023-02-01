<?php
ini_set('display_errors', 1);
require '../util/initialize.php';
require 'service/send_message.php';
require '../util/model/Message.php';

handle("POST", function (mysqli $db) {
    //read request body & put into History object
    $data = json_decode(file_get_contents('php://input'), true);
    $uid = $data['user_id'] ?? "";
    $hid = $data['history_id'] ?? "";
    $message = new Message($hid, $data['user_question'], $data['ai_response']);
    if (!$message->is_valid()) {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

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