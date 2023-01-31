<?php
//echo  "yo";
ini_set('display_errors', 1);
//phpinfo();
$conn = mysqli_connect("containers-us-west-187.railway.app", "root", "kuClq9pNEbhqXbFTP2CG", "railway", "6502");
if ($conn) {
    echo "Connected to the database!";
} else {
    echo "Failed to connect to the database!";
}

mysqli_set_charset($conn, "utf8");
$result = mysqli_query($conn, "select * from messages");

$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}
echo json_encode($arr);