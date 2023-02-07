<?php
require dirname(__FILE__) . "/.." . "/util/initialize.php";
include 'header.php';
$page_title = "View History";
require BASE_DIR . "/api/service/get_all_history.php";

$id = $_GET["id"] ?? '';
if ($id == '') {
    redirect_to("users.php");
}

//caching with redis?
$histories = get_all_history(connectDB(), $id);
?>

<div id="content">
    <div class="pages listing">
        <h1>View History</h1>
        <div class="actions">
            <a class="action" href="users.php">Back to users</a>
        </div>

        <table class="list">
            <tr>
                <th>History Id</th>
                <th>History Name</th>
                <th>History Owner</th>
                <th></th>
                <th></th>
            </tr>

            <?php foreach ($histories as $history) { ?>
                <tr>
                    <td><?php echo $history['id'] ?></td>
                    <td><?php echo $history['name'] ?></td>
                    <td><?php echo $history['user_id'] ?></td>
                    <td><a class="action"
                           href='<?php echo "chat.php?uid=" . $history['user_id'] . "&hid=" . $history['id'] ?>'>View
                            Chat</a>
                    </td>
                    <td><a class="action"
                           href='<?php echo "history_delete_confirm.php?uid=" . $history['user_id'] . "&hid=" . $history['id'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>