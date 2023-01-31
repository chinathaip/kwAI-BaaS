<?php
//echo  "yo";
ini_set('display_errors', 1);
//phpinfo();

$conn = new mysqli("containers-us-west-187.railway.app", "root", "kuClq9pNEbhqXbFTP2CG", "railway", "6502");
$conn->set_charset("utf8mb4");
$result = $conn->query("select * from messages");
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}
echo json_encode($arr);