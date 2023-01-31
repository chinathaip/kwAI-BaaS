<?php
ini_set('display_errors', 1);
require '../util/initialize.php';
require '../util/model/History.php';
require 'service/get_history_by_id.php';
require 'service/create_new_history.php';

proceed("GET", function (mysqli $db) {
    $uid = extract_path_param();
    echo $uid;
    $id = $_GET['id'] ?? "";

    if ($id == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $arr = get_history_by_id($db, $id); //TODO: add uid into argument
    count($arr) > 0 ? http_response_code(HTTP_OK) : http_response_code(HTTP_NOT_FOUND);
    echo json_encode($arr);
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