<?php
session_start();
$uid = $_SESSION['uid'];
include '../connection/connect.php';
include 'header.php';

?>

<br>

<center>
    <h4><b>View my test Details</b></h4>
    <table style="width:80%;margin:30px;">
        <tr>
            <th>Staff Name</th>
            <th>Date</th>
            <th>Test</th>
            <th>Info</th>
            <th>Fees</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        $view = "SELECT `staff`.*,`test`.* FROM `test`,`staff` WHERE `staff`.`sid`=`test`.`sid` AND `test`.`pid`='$uid'";
        $exe = mysqli_query($conn, $view);
        while ($row = mysqli_fetch_array($exe)) {
            $fees_status = $row['fees_status']

        ?>
            <tr>
                <td><?php echo $row['sname'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['test'] ?></td>
                <td><?php echo $row['info'] ?></td>
                <td>Rs.<?php echo $row['fees'] ?>/-</td>
                
                <?php if ($fees_status == "Fees_added") { ?>
                    <td>
                        <a href="payment.php?tid=<?php echo $row['tid'] ?>&fees=<?php echo $row['fees'] ?>" class="btn btn-outline-primary">Pay Now</a>
                    </td>
                <?php } else if ($fees_status == "Payment Completed") { ?>
                    
                    <td>
                        <a>Payment Completed</a>
                        <a href="../image/<?php echo $row['test_file'] ?>" class="btn btn-outline-primary" download>Download File</a>
                    </td>
                    
                <?php } else { ?>
                    <td>Fees Not Added</td>
                <?php } ?>
                <td><a href="delete_test_details.php?tid=<?php echo $row['tid'] ?>" class="btn btn-outline-danger">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
    <br>
</center>


<?php
include 'footer.php';

?>