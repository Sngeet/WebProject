<?php
include '../connection/connect.php';
include 'header.php';

?>


<br>

<center>
    <h4><b>View All Reports</b></h4>
    <table style="width:80%;margin:30px;">
        <tr>
            <th>Id</th>
            <th>Lab Staff</th>
            <th>Patient</th>
            <th>Date</th>
            <th>Test</th>
            <th>Result</th>
            <th>Fees</th>
            <!-- <th>Action</th> -->
        </tr>
        <?php
        $view = "SELECT `patient`.*,`test`.*,`staff`.* FROM `staff`,`test`,`patient` WHERE `patient`.`pid`=`test`.`pid` AND `staff`.`sid`=`test`.`sid`";
        $exe = mysqli_query($conn, $view);
        while ($row = mysqli_fetch_array($exe)) {

        ?>
            <tr>
                <td><?php echo $row['tid'] ?></td>
                <td><?php echo $row['sname'] ?></td>
                <td><?php echo $row['pname'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['test'] ?></td>
                <td><a href="../image/<?php echo $row['test_file'] ?>" class="btn btn-outline-primary">View</a></td>
                <td><?php echo $row['fees'] ?></td>

            </tr>
        <?php } ?>
        <tr>
            <?php
            $qry = "SELECT SUM(fees) AS total_fees FROM test"; // Assigning an alias to the sum
            $exe = mysqli_query($conn, $qry);
            while ($row = mysqli_fetch_array($exe)) {
            ?>
                <td colspan="8" style="text-align:right;">Total Revenue : <b style="color:rgb(94, 169, 19)"><?php echo $row['total_fees'] ?></b> /-</td>
            <?php } ?>
        </tr>
    </table>
    <br>
</center>





<?php
include 'footer.php';

?>