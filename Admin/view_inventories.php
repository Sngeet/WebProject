<?php
include '../connection/connect.php';
include 'header.php';

?>

<br>

<div class="latest-posts-area style-1 py-40">
    <div class="container">
        <div class="section-title">
            <div class="short-title-wrapper">
                <span class="short-title only-divider">WHATS NEW</span>
            </div>
            <div class="main-content">
                <div class="sec-content">
                    <h2 class="title">
                        latest Updated Inventories <br>
                </div>

            </div>
        </div>
        <div class="row gy-5">
            <?php
            $view = "SELECT * FROM `inventory`";
            $exe = mysqli_query($conn, $view);
            while ($row = mysqli_fetch_array($exe)) {

            ?>
                <div class="col-xl-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0s">
                    <div class="post-card style-1">
                        <div class="image">
                            <img src="../image/<?php echo $row['i_image'] ?>" alt="image" />
                            <div class="circle-btn-wrapper">
                                <a href="update_invertory.php?i_id=<?php echo $row['inventory_id'] ?>" class="circle-btn">
                                    <i class="fa-regular fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="content">
                            <div class="tag-wrapper">
                                <span class="single-tag">Stock : <?php echo $row['quantity'] ?></span>
                                <span class="single-tag">Price : <?php echo $row['price'] ?></span>
                            </div>
                            <h3 class="title">
                                <a><?php echo $row['name'] ?></a><span style="font-size: medium;">(<?php echo $row['category'] ?>)</span>
                            </h3>
                            <p><?php echo $row['notes'] ?> <br>
                            Expiry date : <?php echo $row['edate'] ?></p>
                            
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>




<?php
include 'footer.php';

?>