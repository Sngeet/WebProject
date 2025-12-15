<?php
session_start();
$uid = $_SESSION['uid'];
echo $uid;
include '../connection/connect.php';
include 'header.php';


?>


<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Leave Request</h3>
                    <div class="col-auto d-flex w-sm-100">
                        <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#leaveadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Leave</button>
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="atted-info d-flex mb-3 flex-wrap">
                            <div class="full-present me-2">
                                <i class="icofont-check-circled text-success me-1"></i>
                                <span>Present</span>
                            </div>

                            <div class="absent me-2">
                                <i class="icofont-close-circled text-danger me-1"></i>
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
                                    $employeeQry = "SELECT * FROM `employee` WHERE `eid`='$uid'";
                                    $employeeRes = mysqli_query($conn, $employeeQry);
                                    while ($employeeRow = mysqli_fetch_assoc($employeeRes)) :
                                    ?>
                                        <tr>
                                            <td><?php echo $employeeRow['ename']; ?></td>
                                            <?php
                                            // Retrieve attendance for each employee
                                            $employeeId = $employeeRow['eid'];
                                            $attendanceQry = "SELECT `date`, `attendance` FROM `attendance` WHERE `eid` = $employeeId";
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
                                                        echo "<i class='icofont-check-circled text-success'></i>";
                                                    } else {
                                                        echo "<i class='icofont-close-circled text-danger'></i>";
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

<div class="modal fade" id="leaveadd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Leave Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Leave type</label>
                        <select class="form-select" name="leave_type" required>
                            <option selected disabled>Select Leave Type</option>
                            <option value="Medical Leave">Medical Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                        </select>
                    </div>
                    <div class="deadline-form">

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="datepickerdedass" class="form-label">Leave From Date</label>
                                <input type="date" name="sdate" required class="form-control" id="datepickerdedass">
                            </div>
                            <div class="col-sm-6">
                                <label for="datepickerdedoneddsd" class="form-label">Leave to Date</label>
                                <input type="date" name="edate" required class="form-control" id="datepickerdedoneddsd">
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea78d" class="form-label">Leave Reason</label>
                        <textarea class="form-control" name="reason" required id="exampleFormControlTextarea78d" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Reset</button>
                    <button type="submit" class="btn btn-primary" name="submit">Sent</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Leave Approve-->
<div class="modal fade" id="leaveapprove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="dremovetaskLabel">Leave Approve</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center flex-column d-flex">
                <i class="icofont-simple-smile text-success display-2 text-center mt-2"></i>
                <p class="mt-4 fs-5 text-center">Leave Approve Successfully</p>
            </div>
        </div>
    </div>
</div>



<?php


if (isset($_POST['submit'])) {

    $leave_type = $_POST['leave_type'];
    $edate = $_POST['edate'];
    $sdate = $_POST['sdate'];
    $reason = $_POST['reason'];
    $formatted_edate = date("F j, Y", strtotime($edate));
    $formatted_sdate = date("F j, Y", strtotime($sdate));


    $add = "INSERT INTO `leave`(`eid`,`leave_type`,`edate`,`sdate`,`reason`,`status`)VALUES('$uid','$leave_type','$formatted_edate','$formatted_sdate','$reason','Requested')";
    if (mysqli_query($conn, $add)) {
        echo "<script>alert('Leave Request Added'); window.location = 'view_attendance.php';</script>";
    } else {
        echo "<script>alert('Failed');window.location='view_attendance.php';</script>";
    }
}




?>


<?php

include 'footer.php'

?>
