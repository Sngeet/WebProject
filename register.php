<?php
include './connection/connect.php';
include 'header.php';

?>

<div class="contact-form-area style-2 py-140 py-sm-60 py-md-80 py-lg-100">
    <div class="container">
        <div class="shape-overlay-wrapper">
            <div class="shape-overlay">
                <div class="shape-one">
                    <div class="sticky-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z" fill="white" />
                        </svg>
                    </div>
                    <div class="sticky-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z" fill="white" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="image">
                    <img class="tilt-animate" src="images/contact/form-img-3.jpg" alt="contact form image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="comment-respond">
                    <div class="post-comments-title">
                        <h2>Get in touch with us</h2>
                    </div>
                    <form method="post" class="comment-form" enctype="multipart/form-data">
                        <div class="row gx-2">
                            <div class="col-xl-6">
                                <div class="contacts-name">
                                    <input name="name" type="text" required placeholder="Name">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <input name="email" required type="email" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <input name="phone" pattern="[6789][0-9]{9}" type="text" maxlength="10" minlength="10" required placeholder="Enter your number">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <input name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter your Password">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contacts-message">
                                    <textarea name="address" cols="20" required rows="3" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="theme-btn" type="submit" name="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Form Area End -->

<!-- Brand Slider Area End -->

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

<!--- Start Footer !-->

<?php
include 'footer.php';

?>

<?php

if (isset($_POST['submit'])) {

    $Name = $_REQUEST['name'];
    $Phone = $_REQUEST['phone'];
    $Address = $_REQUEST['address'];
    $Email = $_REQUEST['email'];
    $Password = $_REQUEST['password'];
    $currentDate = date("Y-m-d");


    $formattedDate = date("d M Y", strtotime($currentDate));
    echo $formattedDate;

    // $filename = $_FILES["file"]["name"];
    // $tempname = $_FILES["file"]["tmp_name"];
    // $folder = './image/' . $filename;

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `patient` WHERE `pemail` = '$Email' OR `pphone` = '$Phone'";
    $qryOut = mysqli_query($conn, $qryCheck);

    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Email or phone number already exists');
            window.location = 'register.php';
        </script>";
    } else {
        $qryReg = "INSERT INTO `patient`(`pname`,`pemail`,`pphone`,`p_address`) VALUES('$Name','$Email','$Phone','$Address')";
        $qryLog = "INSERT INTO `login` (`rid`, `email`, `password`, `type`) VALUES((SELECT MAX(`pid`) FROM `patient`),'$Email', '$Password', 'Patient')";

        if ($conn->query($qryReg) === TRUE && $conn->query($qryLog) === TRUE) {
            echo "<script>alert('Registration Success'); window.location = 'login.php';</script>";
        } else {
            echo "<script>alert('Registration Failed'); window.location = 'register.php';</script>";
        }
    }
    
}

?>