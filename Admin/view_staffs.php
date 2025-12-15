<?php
include '../connection/connect.php';
include 'header.php';

?>
<br>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<center>
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">View All Staff & Attendance</h3>
                    <div class="col-auto d-flex mt-1 mt-sm-0">
                        <button type="button" class="btn btn-dark  w-sm-100 me-2" data-bs-toggle="modal" data-bs-target="#editattendance"><i class="icofont-edit me-2 fs-6"></i>Add Attendance</button>
                        <!-- <button class="btn btn-primary" type="button">Add Salary</button> -->

                    </div>
                </div>
            </div>
        </div>
</center>
<center>
    <form method="post" class="comment-form" enctype="multipart/form-data">
        <div class="col-xl-6">
            <div class="contacts-message">
                <input name="address" id="searchInput" class="form-control" placeholder="Search Here">
            </div>
        </div>
    </form>
    <!-- <h4><b>View All Staff Details</b></h4> -->
    <table style="width:80%;margin:30px;">
        <thead>
            <tr>
                <th>Staff Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        $view = "SELECT * FROM `staff`";
        $exe = mysqli_query($conn, $view);
        while ($row = mysqli_fetch_array($exe)) {

        ?>
            <tbody id="tableBody">
                <tr>
                    <td><?php echo $row['sid'] ?></td>
                    <td><?php echo $row['sname'] ?></td>
                    <td><?php echo $row['semail'] ?></td>
                    <td><?php echo $row['sphone'] ?></td>
                    <td><?php echo $row['saddress'] ?></td>
                    <td><a href="delete_members.php?sid=<?php echo $row['sid'] ?>&type=staff" class="btn btn-outline-danger">Delete</a></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
    <br>

</center>
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">

        <div class="modal fade" id="editattendance" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="editattendanceLabel"> Add Attendance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Select Employee</label>
                                <select class="form-select" name="eid">
                                    <option value="" selected disabled>Select Employee</option>
                                    <?php
                                    $qry = "SELECT * FROM `staff`";
                                    $exe = mysqli_query($conn, $qry);
                                    while ($row = mysqli_fetch_assoc($exe)) {
                                        $status = $row['status']
                                    ?>
                                        <option value="<?php echo $row['sid'] ?>"><?php echo $row['sname'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="deadline-form">
                                <div class="row g-3 mb-3">

                                    <div class="col-sm-12">
                                        <label class="form-label">Attendance Type</label>
                                        <select class="form-select" name="attendance" required>
                                            <option value="1">Present</option>
                                            <option value="0">Absence</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">reset</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="atted-info d-flex mb-3 flex-wrap">
                            <div class="full-present me-2">
                                <i class='fa fa-check-circle-o text-success' aria-hidden='true'></i>
                                <span>Present</span>
                            </div>

                            <div class="absent me-2">
                                <i class='fa fa-times-circle text-danger' aria-hidden='true'></i>
                                <span>Absence</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <?php
                                        // Retrieve distinct dates from the attendance table
                                        $dateQry = "SELECT DISTINCT `date` FROM `attendance` ORDER BY `date`";
                                        $dateRes = mysqli_query($conn, $dateQry);
                                        while ($dateRow = mysqli_fetch_assoc($dateRes)) {
                                            echo "<th>" . $dateRow['date'] . "</th>";
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $employeeQry = "SELECT * FROM `staff`";
                                    $employeeRes = mysqli_query($conn, $employeeQry);
                                    while ($employeeRow = mysqli_fetch_assoc($employeeRes)) :
                                    ?>
                                        <tr>
                                            <td><?php echo $employeeRow['sname']; ?></td>
                                            <?php
                                            // Retrieve attendance for each employee
                                            $employeeId = $employeeRow['sid'];
                                            $attendanceQry = "SELECT `date`, `attendance` FROM `attendance` WHERE `sid` = $employeeId";
                                            $attendanceRes = mysqli_query($conn, $attendanceQry);
                                            $attendanceData = array();
                                            while ($attendanceRow = mysqli_fetch_assoc($attendanceRes)) {
                                                $attendanceData[$attendanceRow['date']] = $attendanceRow['attendance'];
                                            }
                                            // Loop through distinct dates and display attendance
                                            $dateRes = mysqli_query($conn, $dateQry);
                                            while ($dateRow = mysqli_fetch_assoc($dateRes)) {
                                                $date = $dateRow['date'];
                                                echo "<td>";
                                                if (isset($attendanceData[$date])) {
                                                    $status = $attendanceData[$date];
                                                    if ($status == 1) {
                                                        echo "<i class='fa fa-check-circle-o text-success' aria-hidden='true'></i>";
                                                    } else {
                                                        echo "<i class='fa fa-times-circle text-danger' aria-hidden='true'></i>";
                                                    }
                                                } else {
                                                    echo "N/A";
                                                }
                                                echo "</td>";
                                            }
                                            ?>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
    </div>
</div>


<?php
include 'footer.php';

?>


<?php



if (isset($_POST['submit'])) {

    $eid = $_POST['eid'];
    $attendance = $_POST['attendance'];
    $date = date('Y-m-d');
    $formatted_dob = date("F j, Y", strtotime($date));
    echo $date;
    echo $formatted_dob;


    $add = "INSERT INTO `attendance` (`sid`,`attendance`,`date`)VALUES('$eid','$attendance',CURDATE())";
    if (mysqli_query($conn, $add)) {
        echo "<script>alert('Attendance Added'); window.location = 'view_staffs.php';</script>";
    } else {
        echo "<script>alert('Failed'); window.location = 'view_staffs.php';</script>";
    }
}




?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle search input
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            var rows = $("#tableBody tr");
            var matchingRows = rows.filter(function() {
                var rowText = $(this).text().toLowerCase();
                return rowText.indexOf(value) > -1;
            });
            rows.hide(); // Hide all rows initially
            matchingRows.show(); // Show matching rows
            if (matchingRows.length === 0) {
                $("#noMatchingData").show(); // Show message if no matching rows
                $("#table").hide();
            } else {
                $("#noMatchingData").hide(); // Hide message if there are matching rows
                $("#table").show();
            }
        });
    });
</script>