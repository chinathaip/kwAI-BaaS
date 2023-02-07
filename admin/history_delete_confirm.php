<?php
require dirname(__FILE__) . "/.." . "/util/initialize.php";
include 'header.php';
$page_title = "Delete Confirmation";
require BASE_DIR . "/api/service/delete_history.php";

$uid = $_GET["uid"] ?? '';
$hid = $_GET["hid"] ?? '';
if ($uid == '' || $hid == '') {
    redirect_to("users.php");
}

$history_page = "history.php?id=" . $uid;

if (is_post_request()) {
    if ($_POST['submit'] == 'No') {
        redirect_to($history_page);
    }

    if (delete_history(connectDB(), $uid, $hid)) {
        redirect_to($history_page);
    } else {
        echo "<div class='error'>Error deleting history</div>";
    }
}


?>
<div id="content">
    <h1>Delete Confirmation</h1>
    <div class="actions">
        <a class="action" href="<?php echo $history_page ?>">Back to history</a>
    </div>
    <p>Are you sure you want to delete this history?</p>
    <form action="<?php echo "history_delete_confirm.php?uid=" . $uid . "&hid=" . $hid ?>" method="post">
        <input type="submit" name="submit" value="Yes"/>
        <input type="submit" name="submit" value="No"/>
    </form>
</div>

