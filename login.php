<?php
session_start();
include './connection/connect.php';
include 'header.php';

?>

<style>
    #inp{
        border: 1px solid rgb(178, 217, 139) !important;
    }
</style>

<div class="contact-form-area style-2 py-140 py-sm-60 py-md-80 py-lg-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="image">
                    <img class="tilt-animate" src="images/contact/form-img-3.png" alt="contact form image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="comment-respond">
                    <div class="post-comments-title">
                        <h2>Login</h2>
                    </div>
                    <form method="post" class="comment-form">
                        <div class="row gx-2">
                           
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <input name="email" type="text" style="border: 1px solid ;" id="inp" required placeholder="Your Email">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <input name="password" type="text" id="inp" required placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="theme-btn" name="submit" type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Form Area End -->

<!-- Header Search Bar Modal Start -->
<div class="search-form-wrapper">
    <div class="search-form-inner">
        <div class="search-content-filed">
            <form role="search" method="get" class="search-form" action="#">
                <input type="hidden" name="post_type" value="post" />
                <div class="search-form-input">
                    <div class="search-icon">
                        <i class="fa-light fa-magnifying-glass"></i>
                    </div>
                    <input type="search" placeholder="Search" />
                    <button class="theme-btn" type="submit" title="Search" aria-label="Search">
                        Search
                    </button>
                </div>
            </form>
            <span class="search-close">
                <i class="fa-light fa-xmark"></i>
            </span>
        </div>
    </div>
</div>
<!-- Header Search Bar Modal End -->

<!-- Scroll Up Section Start -->
<div id="scrollTop" class="scrollup-wrapper">
    <div class="scrollup-btn">
        <i class="fa-regular fa-arrow-up"></i>
    </div>
</div>
<!-- Scroll Up Section End -->


<?php
include 'footer.php';

?>

<?php

if (isset($_REQUEST['submit'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    // Fetch the hashed password from the database
    $qry = "SELECT * FROM `login` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $qry);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $hashed_password = $data['password'];

        // Verify the provided password against the hashed password
        if (crypt($password, $hashed_password) === $hashed_password) {
            $uid = $data['rid'];
            $type = $data['type'];
            $status = $data['status'];

            $_SESSION['uid'] = $uid;
            $_SESSION['type'] = $type;

            if ($type == 'Admin') {
                echo "<script>alert('Welcome to AdminHome '); window.location = 'Admin/index.php'</script>";
            } else if ($type == 'Patient') {
                echo "<script>alert('Welcome User'); window.location = 'Patient/index.php'</script>";
            } else if ($type == 'Staff') {
                echo "<script>alert('Welcome '); window.location = 'Staff/index.php'</script>"; 
            } else {
                echo "<script>alert('Login Failed')</script>";
            }
        } else {
            echo "<script>alert('Invalid Email / Password'); window.location = 'login.php'</script>";
        }
    } else {
        echo "<script>alert('Invalid Email / Password'); window.location = 'login.php'</script>";
    }
}
?>
