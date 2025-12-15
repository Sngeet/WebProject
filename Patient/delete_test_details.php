<?php
include '../connection/connect.php';
$tid = $_REQUEST['tid'];

?>


<?php

$del = "DELETE FROM `test` WHERE `tid`='$tid'";

if ($conn->query($del) == TRUE) {
    echo "<script>alert('Test Date Removed'); window.location = 'my_test.php';</script>";
} else {
    echo "<script>alert('Failed'); window.location = 'my_test.php';</script>";
}


?>