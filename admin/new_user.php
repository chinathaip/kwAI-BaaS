<?php

require dirname(__FILE__) . "/.." . "/util/initialize.php";

?>

<div id="content">

    <a class="back-link" href="<?php echo
    url_for(''); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create New User</h1>

        <form action="" method="post">
            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="" /></dd>
            </dl>
            <dl>
                <dt>Password</dt>
                <dd><input type="password" name="menu_name" value="" /></dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Create New" />
            </div>
        </form>
    </div>
</div>

