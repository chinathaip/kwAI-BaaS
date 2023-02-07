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
?>
<div id="content">
    <h1>Delete Confirmation</h1>
    <div class="actions">
        <a class="action" href="users.php">Back to users</a>
    </div>
    <p>Are you sure you want to delete this history?</p>
    <form action="<?php echo "history_delete_confirm.php?uid=" . $uid . "&hid=" . $hid ?>" method="post">
        <input type="submit" name="submit" value="Yes"/>
        <input type="submit" name="submit" value="No"/>
    </form>
    <!--    TODO: check if post -> if submit = yes -> delete append "deleted"-->
    <?php
    if (is_post_request() && $_POST['submit'] == 'Yes') {
        delete_history(connectDB(), $uid, $hid);
    } else {
        redirect_to("users.php");
    }
    ?>
</div>

