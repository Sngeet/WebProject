<?php
include '../connection/connect.php';
include 'header.php';

?>

<br>

<center>
    <h4><b>View All Patients Details</b></h4><br>
    <form method="post" class="comment-form" enctype="multipart/form-data">
        <div class="col-xl-6">
            <div class="contacts-message">
                <input name="address" id="searchInput" class="form-control" placeholder="Search Here">
            </div>
        </div>
    </form>
    <table style="width:80%;margin:30px;">
        <thead>

            <tr>
                <th>Patient Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        $view = "SELECT * FROM `patient`";
        $exe = mysqli_query($conn, $view);
        while ($row = mysqli_fetch_array($exe)) {

        ?>
            <tbody id="tableBody">

                <tr>
                    <td><?php echo $row['pid'] ?></td>
                    <td><?php echo $row['pname'] ?></td>
                    <td><?php echo $row['pemail'] ?></td>
                    <td><?php echo $row['pphone'] ?></td>
                    <td><?php echo $row['p_address'] ?></td>
                    <td><a href="delete_members.php?sid=<?php echo $row['pid'] ?>&type=patient" class="btn btn-outline-danger">Delete</a></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
    <br>
</center>


<?php
include 'footer.php';

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