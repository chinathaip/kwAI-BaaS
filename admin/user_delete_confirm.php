<?php
require dirname(__FILE__) . "/.." . "/util/initialize.php";
include 'header.php';
$page_title = "User Delete Confirmation";
require BASE_DIR . "/api/service/delete_user.php";


$uid = $_GET["id"] ?? '';
if ($uid == '') {
    redirect_to("users.php");
}

if (is_post_request()) {
    if ($_POST['submit'] == 'No') {
        redirect_to("users.php");
    }

    if (delete_user(connectDB(), $uid)) {
        redirect_to("users.php");
    } else {
        echo "<div class='error'>Error deleting user</div>";
    }
}

?>

<div id="content">
    <h1>Delete Confirmation</h1>
    <div class="actions">
        <a class="action" href="<?php echo "users.php" ?>">Back to users</a>
    </div>
    <p>Are you sure you want to delete this user?</p>
    <form action="<?php echo "user_delete_confirm.php?id=" . $uid ?>" method="post">
        <input type="submit" name="submit" value="Yes"/>
        <input type="submit" name="submit" value="No"/>
    </form>
</div>
