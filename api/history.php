<?php
ini_set('display_errors', 1);
require '../util/initialize.php';

proceed("GET", function (mysqli $db) {
    $id = $_GET['id'] ?? "";

    if ($id == "") {
        http_response_code(HTTP_BAD_REQUEST);
        exit();
    }

    $result = $db->query("select id, user_question, ai_response from messages where messages.history_id = " . $id);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }

    count($arr) > 0 ? http_response_code(HTTP_OK) : http_response_code(HTTP_NOT_FOUND);
    echo json_encode($arr);
});

proceed("POST", function (mysqli $db) {
    http_response_code(HTTP_OK);
    $data = json_decode(file_get_contents('php://input'), true);
    echo "history id: " . $data['history_id'];
    echo "user id: " . $data['user_id'];
    foreach ($data['messages'] as $message) {
        echo "question: ". $message['user_question'];
        echo "answer: ". $message['ai_response'];
    }
//    $history = new history($data['id'], $data['user_question'], $data['ai_response']);
//    echo $history->id;
//    echo $history->user_question;
//    echo $history->ai_response;

//    if ($id == "" || $user_question == "" || $ai_response == "") {
//        http_response_code(HTTP_BAD_REQUEST);
//        exit();
//    }
//
//    $stmt = $db->prepare("insert into messages (user_question, ai_response, history_id) values (?, ?, ?)");
//    $stmt->bind_param("iss", $id, $user_question, $ai_response);
//    $stmt->execute();
//    $stmt->close();
//
//    http_response_code(HTTP_CREATED);
});