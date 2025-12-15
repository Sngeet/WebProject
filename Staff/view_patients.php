<?php
session_start();
$uid = $_SESSION['uid'];
include '../connection/connect.php';
include 'header.php';

?>

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

<br>

<center>
    <h4><b>View Patients Details</b></h4>
    <table style="width:80%;margin:30px;">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        <?php
        $view = "SELECT * FROM `patient` WHERE `sid`='$uid'";
        $exe = mysqli_query($conn, $view);
        while ($row = mysqli_fetch_array($exe)) {

        ?>
            <tr>
                <td><?php echo $row['pname'] ?></td>
                <td><?php echo $row['pemail'] ?></td>
                <td><?php echo $row['pphone'] ?></td>
                <td><?php echo $row['p_address'] ?></td>
                <td><a href="delete_members.php?sid=<?php echo $row['pid'] ?>&type=patient" class="btn btn-outline-danger">Delete</a>
                    <a href="add_test.php?pid=<?php echo $row['pid'] ?>" class="btn btn-outline-success">Add test</a>
                    <a href="test_records.php?pid=<?php echo $row['pid'] ?>" class="btn btn-outline-warning">View test</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
</center>


<?php
include 'footer.php';

?>