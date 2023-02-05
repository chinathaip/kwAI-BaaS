<?php
require dirname(__FILE__) . "/.." . "/util/initialize.php";
$page_title = "Manage Users";
include 'header.php';
require BASE_DIR . "/api/service/get_all_users.php";
require BASE_DIR . "/util/model/User.php";

//caching with redis?
$users = get_all_users(connectDB());
?>

<div id="content">
    <div class="pages listing">
        <h1>Manage Users</h1>
        <div class="actions">
            <a class="action" href="<?php echo url_for("") ?>">Create New User</a>
        </div>

        <table class="list">
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Password</th>
                <th></th>
                <th></th>
            </tr>

            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user->id ?></td>
                    <td><?php echo $user->username ?></td>
                    <td><?php echo $user->password ?></td>
                    <td><a class="action" href='<?php echo "history.php?id=" . $user->id?>'>View History</a></td>
                    <td><a class="action" href=''>Delete</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>