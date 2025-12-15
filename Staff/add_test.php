<?php
session_start();
$uid=$_SESSION['uid'];
include '../connection/connect.php';
include 'header.php';
$pid = $_REQUEST['pid'];

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
            <div class="col-md-3"></div>

            <div class="col-lg-6">
                <div class="comment-respond">
                    <div class="post-comments-title">
                        <h2>Add Test Details</h2>
                    </div>
                    <form method="post" class="comment-form" enctype="multipart/form-data">

                        <div class="row gx-2">
                            <?php
                            $view = "SELECT * FROM `patient` WHERE `pid`='$pid'";
                            $exe = mysqli_query($conn, $view);
                            while ($row = mysqli_fetch_array($exe)) {

                            ?>
                                <div class="col-xl-6">
                                    <div class="contacts-name">
                                        <label for="">Patient Name</label>
                                        <input name="name" type="text" value="<?php echo $row['pname'] ?>" readonly required placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="contacts-email">

                                        <label for="">Patient Email</label>
                                        <input name="email" required value="<?php echo $row['pemail'] ?>" readonly type="text" placeholder="Your Email">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <select id="lapTestSelect" name="test">
                                        <option disabled selected>Select Test</option>
                                        <option value="bloodTest">Blood Test</option>
                                        <option value="urineTest">Urine Test</option>
                                        <option value="xray">X-Ray</option>
                                        <option value="MRI">MRI Scan</option>
                                        <option value="CTscan">CT Scan</option>
                                        <option value="ultrasound">Ultrasound</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <input name="date" type="date" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contacts-message">
                                    <textarea name="desc" cols="20" required rows="3" placeholder="Add addtional info"></textarea>
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



<div id="scrollTop" class="scrollup-wrapper">
    <div class="scrollup-btn">
        <i class="fa-regular fa-arrow-up"></i>
    </div>
</div>

<?php
include 'footer.php';

?>


<?php

if (isset($_POST['submit'])) {

    $test = $_REQUEST['test'];
    $date = $_REQUEST['date'];
    $desc = $_REQUEST['desc'];
    $currentDate = date("Y-m-d");

    $formattedDate = date("d M Y", strtotime($currentDate));
    echo $formattedDate;

    $qryReg = "INSERT INTO `test` (`sid`,`pid`,`test`,`date`,`info`)VALUES('$uid','$pid','$test','$date','$desc')";

    if ($conn->query($qryReg) == TRUE) {
        echo "<script>alert('Test Samples Added'); window.location = 'add_test.php?pid=$pid';</script>";
    } else {
        echo "<script>alert('Failed'); window.location = 'add_test.php?pid=$pid';</script>";
    }
}


?>