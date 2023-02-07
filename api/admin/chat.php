<?php
require dirname(__FILE__) . "/../.." . "/util/initialize.php";
$page_title = "View Chat";
include 'header.php';
require BASE_DIR . "/api/service/get_user_history_by_id.php";

$uid = $_GET['uid'] ?? '';
$hid = $_GET['hid'] ?? '';
if ($uid == '' || $hid == '') {
    redirect_to("users.php");
}

$messages = get_user_history_by_id(connectDB(), $uid, $hid);
?>
<link rel="stylesheet" href=<?php echo url_for('/stylesheets/chat.css'); ?>>
<a href="<?php echo url_for("/history.php?id=" . $uid) ?>">Back to History</a>
<h1>Messages: </h1>
<div class="chat-container">
    <?php foreach ($messages as $message): ?>
        <div class="chat-question">
            <?php echo "Question: " . $message['user_question']; ?> <br>
        </div>
        <div class="chat-answer">
            <?php echo "Answer: " . $message['ai_response']; ?> <br>
        </div>
    <?php endforeach; ?>
</div>