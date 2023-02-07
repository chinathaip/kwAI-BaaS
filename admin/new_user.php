<?php
ini_set('display_errors', 1);
require dirname(__FILE__) . "/.." . "/util/initialize.php";
require BASE_DIR . "/api/service/create_new_users.php";
include 'header.php';

if (is_post_request()) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';


    if ($username != '' && $password != '') {
        $hashedPw = password_hash($password, PASSWORD_DEFAULT);
        if (create_new_users(connectDB(), $username, $hashedPw)) {
            redirect_to("users.php");
        }
        echo "<div class='errors'>Username already exists.</div>";

    } else {
        echo "<div class='errors'>Username and password cannot be blank.</div>";
    }
}
?>

<div id="content">
    <a class="back-link" href="users.php">&laquo; Back to Users</a>

    <div class="subject new">
        <h1>Create New User</h1>

        <form action="" method="post">
            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value=""/></dd>
            </dl>
            <dl>
                <dt>Password</dt>
                <dd><input type="password" name="password" value=""/></dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Create New"/>
            </div>
        </form>
    </div>
</div>