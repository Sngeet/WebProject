<?php
session_start();
$uid = $_SESSION['uid'];
include '../connection/connect.php';
include 'header.php';
$pid = $_REQUEST['pid'];

?>

<style>
    select {
        appearance: none;
        background-color: initial;
        cursor: default;
        align-items: baseline;
        color: inherit;
        text-overflow: ellipsis;
        text-align: start !important;
        padding: initial;
        border: initial;
        white-space: pre;
        overflow: hidden !important;
    }
</style>

<div class="page-breadcrumb-area style-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <div class="page-heading">
                        <h3 class="page-title">Medical Lab</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="latest-posts-area style-2 py-140">
    <div class="container">
        <div class="row">
            <div class="12">
                <div class="section-title">
                    <div class="short-title-wrapper">
                        <span class="short-title only-divider">NEW TESTS</span>
                    </div>
                    <div class="main-content">
                        <div class="sec-content">
                            <center>
                                <h3>
                                    Records of recently <br>administered tests.</h3>
                            </center>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                $view = "SELECT `patient`.*,`test`.* FROM `test`,`patient` WHERE `test`.`pid`=`patient`.`pid` AND test.`sid`='$uid' AND `test`.`pid`='$pid'";
                $exe = mysqli_query($conn, $view);

                if ($exe && mysqli_num_rows($exe) > 0) {
                    while ($row = mysqli_fetch_array($exe)) {
                        $status=$row['status']
                ?>

                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow animate__animated animate__flipInY animate__slow">
                            <div class="post-card style-2">
                                <div class="content">
                                    <div class="post-meta">
                                        <a class="single-post-meta">
                                            <span><b><?php echo $row['pname'] ?></b></span>
                                        </a>
                                        <span class="dots"></span>
                                        <a class="single-post-meta">
                                            <span><?php echo $row['date'] ?></span>
                                        </a>
                                    </div>
                                    <div class="tag-wrapper">
                                        Test Name :
                                        <span class="single-tag"><?php echo $row['test'] ?></span>
                                    </div>
                                    <h3 class="title">
                                        <a href=""><?php echo $row['info'] ?></a>
                                    </h3>
                                    <center>
                                        <a>Status : <span style="color:red"><?php echo $row['status'] ?></span></a><br>
                                        Upload test Result
                                    </center>
                                    <?php if ($status == "Test Completed") { ?>
                                        <div class="tag-wrapper">
                                            <center><a class="single-tag">Test And Fees  Rs.<b style="color:red;"><?php echo $row['fees'] ?></b>/- Added</a></center>
                                        </div>

                                    <?php } else { ?>

                                        <div class="tag-wrapper">
                                            <input class="single-tag" type="file" name="file">

                                            <select class="single-tag" name="status" id="select">
                                                <option disabled selected>Select Status</option>
                                                <option value="Test Completed">Test Completed</option>
                                                <option value="In Progress">In Progress</option>

                                                <!-- Add more options as needed -->
                                            </select>
                                            <input type="hidden" name="test_id" value="<?php echo $row['tid'] ?>" id="">
                                            <input type="text" placeholder="Enter Fees*" name="fees" class="single-tag" id="">

                                        </div>
                                        <button class="btn btn-outline-warning" name="submit" type="submit">Upload</button>
                                    <?php } ?>

                                </div>

                                <div class="shape">
                                    <svg width="111" height="111" viewBox="0 0 111 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0C19.33 0 35 15.67 35 35V41C35 60.33 50.67 76 70 76H76C95.33 76 111 91.67 111 111V0H0Z" fill="white"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                } else {
                    ?>
                    <center>
                        <h4 style="color: red;"> Test Result Not Found</h4>
                    </center>
                <?php } ?>
            </form>
        </div>

    </div>
</div>


<?php
include 'footer.php';

?>


<?php

if (isset($_POST['submit'])) {

    // $file = $_REQUEST['file'];
    $status = $_REQUEST['status'];
    $fees = $_REQUEST['fees'];
    $test_id = $_REQUEST['test_id'];
    $currentDate = date("Y-m-d");

    $formattedDate = date("d M Y", strtotime($currentDate));
    echo $formattedDate;

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = '../image/' . $filename;

    if ($filename) {

        if (move_uploaded_file($tempname, $folder)) {
            $qryReg = "UPDATE `test` SET `status`='$status',`test_file`='$filename',`fees`='$fees' ,`fees_status`='Fees_added' WHERE `test`.`tid`='$test_id'";

            if ($conn->query($qryReg) == TRUE) {
                echo "<script>alert('Test Files and status Uploaded'); window.location = 'view_patients.php';</script>";
            } else {
                echo "<script>alert('Failed'); window.location = 'view_patients.php';</script>";
            }
        }
    } else {
        $qryReg = "UPDATE `test` SET `status`='$status',`fees`='$fees',`fees_status`='Fees_added' WHERE `test`.`tid`='$test_id'";

        if ($conn->query($qryReg) == TRUE) {
            echo "<script>alert('Fees and status Updated'); window.location = 'view_patients.php';</script>";
        } else {
            echo "<script>alert('Failed'); window.location = 'view_patients.php';</script>";
        }
    }
}


?>