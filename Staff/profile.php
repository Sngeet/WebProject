<?php
session_start();
$uid = $_SESSION['uid'];
include '../connection/connect.php';
include 'header.php'
?>
<style>
    body {
        /* margin-top: 20px; */
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;
    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }

    /* Image Upload */

    .image-upload>input {
        display: none;
    }

    #images {
        cursor: pointer;
        height: 150px;
        width: 150px;
        padding: 10px;
        border-radius: 100px;
    }

    /* article,
    aside,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
        display: block;
    } */

    /* Image upload */
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
<br><br>
<div class="container">
    <div class="main-body">
        <form action="" method="post" enctype="multipart/form-data">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb" style="border : 1px solid #ced2d8; border-radius: 4px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="" style="position: relative;top: 8px;"><b>&nbsp;&nbsp;&nbsp;User Profile</b></a>
                    </li>
                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li> -->
                </ol>

            </nav><br>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">

                <?php

                $view = "SELECT `staff`.*,`login`.* FROM `staff`,`login` WHERE `staff`.`sid`=`login`.`rid` AND `login`.`rid`='$uid' AND `login`.`type`='Staff'";
                $exe = mysqli_query($conn, $view);
                while ($row = mysqli_fetch_array($exe)) {
                    $Password = $row['password'];


                ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <!-- <img src="../images/<?php echo $row['uimage'] ?>" alt="Admin" class="rounded-circle"
                                        width="150"> -->
                                    <div class="image-upload text-center">
                                        <label for="file-input">
                                            <img id="img" src="../images/staff-care.png  " alt="Upload Image" style="margin: auto" class="rounded-circle" width="150" />
                                        </label>
                                        <!-- <p>Select Profile Image</p> -->
                                        <!-- <input id="file-input" onchange="readURL(this)" name="file" type="file" /> -->
                                    </div>
                                    <div class="mt-3">
                                        <h4>
                                            <b>
                                                <?php echo $row['sname'] ?>
                                            </b>
                                        </h4>
                                        <p class="text-secondary mb-1">Type : Staff</p>
                                        <p class="text-muted font-size-sm">
                                            <?php echo $row['saddress'] ?>
                                        </p>
                                        <!-- Password : <input type="text" readonly name="password"
                                            value="<?php echo $row['password'] ?>" id="" class="form-control"> -->
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <center><button type="submit" name="submit" class="btn btn-info " style="width:300px">Update</button></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" value="<?php echo $row['sname'] ?>" id="" class="form-control" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" value="<?php echo $row['semail'] ?> " id="" class="form-control" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" value="<?php echo $row['sphone'] ?>" id="" class="form-control" required>

                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="password" value="" id="" class="form-control" required>

                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" value="<?php echo $row['saddress'] ?>" id="" class="form-control" required>

                                    </div>
                                </div>

                            </div>
                        </div>




                    </div>
                <?php } ?>

            </div>
        </form>
    </div>
</div>
<br><br>

<?php
include 'footer.php'
?>


<?php

if (isset($_REQUEST['submit'])) {

    $Name = $_REQUEST['name'];
    $Phone = $_REQUEST['phone'];
    $Address = $_REQUEST['address'];
    $Email = $_REQUEST['email'];
    $Password = $_REQUEST['password'];
    $currentDate = date("Y-m-d");
    echo $currentDate;

    
    // Generate a random salt using mt_rand() and uniqid()
    $salt = base64_encode(mt_rand() . uniqid());

    // Hash the password using crypt() with bcrypt algorithm
    $hashed_password = crypt($Password, '$2a$10$' . $salt);

    $formattedDate = date("d M Y", strtotime($currentDate));
    echo $formattedDate;

    $qryReg = "UPDATE `staff` SET `sname`='$Name',`sphone`='$Phone',`semail`='$Email',`saddress`='$Address' WHERE `sid`='$uid'";
    $qryLog = "UPDATE `login` SET `password`='$hashed_password' WHERE `rid`='$uid' and `type`='Staff'";

    echo $qryReg . "&& " . $qryLog;

    if ($conn->query($qryReg) == TRUE && $conn->query($qryLog) == TRUE) {
        echo "<script>alert('Profile Details Updated'); window.location = 'profile.php';</script>";
    } else {
        echo "<script>alert('Failed'); window.location = 'profile.php';</script>";
    }
}


?>

<script>
    $(function() {
        $("button[type='submit']").click(function(event) {
            var $fileUpload = $("input[type='file']");
            if (parseInt($fileUpload.get(0).files.length) === 0) {
                alert("Please select an Image");
                event.preventDefault(); // Prevent form submission
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#img").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file-input").on("change", function() {
            readURL(this);
        });
    });
</script>