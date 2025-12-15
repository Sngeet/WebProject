<?php
include '../connection/connect.php';
$sid = $_REQUEST['sid'];
$type = $_REQUEST['type'];

?>


<?php

if ($type == 'staff') {

    $del = "DELETE FROM `staff` WHERE `sid`='$sid'";
    $dell = "DELETE FROM `login` WHERE `rid`='$sid' and `type`='Staff'";

    if ($conn->query($del) == TRUE && $conn->query($dell) == TRUE) {
        echo "<script>alert('Staff Removed'); window.location = 'view_staffs.php';</script>";
    } else {
        echo "<script>alert('Failed'); window.location = 'view_staffs.php';</script>";
    }
} else {
    $del = "DELETE FROM `patient` WHERE `pid`='$sid'";
    $dell = "DELETE FROM `login` WHERE `rid`='$sid' and `type`='Patient'";

    if ($conn->query($del) == TRUE && $conn->query($dell) == TRUE) {
        echo "<script>alert('Patient details Removed'); window.location = 'view_patients.php';</script>";
    } else {
        echo "<script>alert('Failed'); window.location = 'view_patients.php';</script>";
    }
}


?>