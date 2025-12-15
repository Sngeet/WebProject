<?php
include '../connection/connect.php';
include 'header.php';

?>

<div class="contact-form-area style-2 py-100 py-sm-60 py-md-80 py-lg-100">
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
                    <img class="tilt-animate" src="../images/contact/cashier.png" alt="contact form image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="comment-respond">
                    <div class="post-comments-title">
                        <h2>Add New Inventory</h2>
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
                                    <input name="quantity" type="number" required placeholder="Quantity">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <label for="">Expiration Date</label>
                                    <input name="expirationDate" type="date" required placeholder="Expiration Date">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-email">
                                    <label for="">Select Category</label>
                                    <select name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="Medication">Medication</option>
                                        <option value="Lab Supplies">Lab Supplies</option>
                                        <option value="Personal Protective Equipment">Personal Protective Equipment</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-xl-6">
                                <div class="contacts-message">
                                    <input name="price" type="text" title="Enter a valid price, e.g., 10.99" placeholder="Price (Rs)" required>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contacts-message">
                                    <input name="file" type="file" required>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="contacts-message">
                                    <textarea name="notes" cols="30" rows="4" required placeholder="Additional Notes" style="margin-top: -100px;"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <center><button style="margin-top: -100px;" class="theme-btn" name="submit" type="submit">Submit Now</button></center>
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
    // Assuming $conn is your database connection
    $Name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $expirationDate = $_POST['expirationDate'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $notes = $_POST['notes'];


    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = '../image/' . $filename;


    if ($filename) {
        if (move_uploaded_file($tempname, $folder)) {
            $qryReg = "INSERT INTO `inventory` (`name`,`quantity`,`edate`,`category`,`price`,`notes`,`i_image`)VALUES('$Name','$quantity','$expirationDate','$category','$price','$notes','$filename')";
            if ($conn->query($qryReg) == TRUE) {
                echo "<script>alert('Inventory Added Successfully'); window.location = './add_invertory.php';</script>";
            } else {
                echo "<script>alert('Failed'); window.location = './add_invertory.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to move file'); window.location = './add_invertory.php';</script>";
        }
    } else {
        $qryReg = "INSERT INTO `inventory` (`name`,`quantity`,`edate`,`category`,`price`,`notes`)VALUES('$Name','$quantity',)'$expirationDate','$category','$price','$notes'";

        if ($conn->query($qryReg) === TRUE) {
            echo "<script>alert('Inventory Added Successfully'); window.location = './add_invertory.php';</script>";
        } else {
            echo "<script>alert('Failed'); window.location = './add_invertory.php';</script>";
        }
    }
}
?>