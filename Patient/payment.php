<?php
session_start();
$uid = $_SESSION['uid'];
include '../connection/connect.php';
// include 'header.php';
$tid = $_REQUEST['tid'];
$fees = $_REQUEST['fees'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Medical Lab</title>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            background-image: url(../images/sl_020622_4930_21.jpg);
            background-position: center;
            background-size: cover;
        }

        .container {
            background-color: rgba(127, 148, 167, 0.423);
            padding: 30px;
            border-radius: 10px;
            color: aliceblue;
            -webkit-box-shadow: -7px -5px 15px 5px #65bc6057, 12px -5px 15px 5px #80c8ffbb, 0px 0px 14px 12px rgba(0, 0, 0, 0.09);
            box-shadow: -7px -5px 15px 5px #6ec76a53, 12px -5px 15px 5px #80c8ff6c, 0px 0px 14px 12px rgba(0, 0, 0, 0.09);
        }
    </style>

</head>

<body>
    <!-- partial:index.partial.html -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <div class="container" style="margin-top:150px;width:500px;">
        <div id="Checkout" class="inline">
            <h1>Payment Invoice</h1>
            <div class="card-row">
                <span class="visa"></span>
                <span class="mastercard"></span>
                <span class="amex"></span>
                <span class="discover"></span>
            </div>
            <form method="post">
                <div class="form-group">
                    <label for="PaymentAmount">Payment amount</label>
                    <div class="amount-placeholder">
                        <span>₹</span>
                        <span>
                            <b style="color:rgb(86, 167, 6);">
                                <?php echo $fees ?>.00
                            </b>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <?php
                    $sel = "SELECT `patient`.*,`test`.* FROM `test`,`patient` WHERE `test`.`pid`=`patient`.`pid` AND `test`.`tid`='$tid'";
                    $exe = mysqli_query($conn, $sel);
                    while ($row = mysqli_fetch_array($exe)) {

                        ?>
                    <label or="NameOnCard">Name on card</label>
                    <input id="NameOnCard" class="form-control" readonly value="<?php echo $row['pname'] ?>" type="text"
                        maxlength="255" required></input>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="CreditCardNumber">Card number</label>
                    <input id="CreditCardNumber" required maxlength="19" minlength="19"
                        oninput="formatCreditCardNumber(this);" class="null card-image form-control" type="text"
                        placeholder="xxxx xxxx xxxx xxxx"></input>
                </div>
                <div class="expiry-date-group form-group">
                    <label for="ExpiryDate">Expiry date</label>
                    <input id="ExpiryDate" class="form-control" required oninput="formatExpiryDate(this);" type="text"
                        placeholder="MM / YY" maxlength="7"></input>
                </div>
                <div class="security-code-group form-group">
                    <label for="SecurityCode">Security code</label>
                    <div class="input-container">
                        <input id="SecurityCode" class="form-control" required maxlength="3" minlength="3" type="text"
                            placeholder="CVV"></input>
                        <i id="cvc" class="fa fa-question-circle"></i>
                    </div>
                    <div class="cvc-preview-container two-card hide">
                        <div class="amex-cvc-preview"></div>
                        <div class="visa-mc-dis-cvc-preview"></div>
                    </div>
                </div>

                <button id="PayButton" class="btn btn-block btn-success submit-button" name="submit" type="submit">
                    <span class="submit-button-lock"></span>
                    <span class="align-middle">Pay ₹
                        <?php echo $fees ?>.00
                    </span>
                </button>
            </form>
        </div>
    </div>
    <!-- partial -->
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
    <script src="./script.js"></script>


    <script>
        function formatCreditCardNumber(input) {
            // Remove any non-numeric characters
            let cardNumber = input.value.replace(/\D/g, '');
            // Split the card number into groups of four
            let formattedCardNumber = '';
            for (let i = 0; i < cardNumber.length; i += 4) {
                formattedCardNumber += cardNumber.slice(i, i + 4) + ' ';
            }
            // Trim any extra space at the end
            formattedCardNumber = formattedCardNumber.trim();
            // Update the input field with the formatted number
            input.value = formattedCardNumber;
        }
    </script>

    <script>
        function formatExpiryDate(input) {
            // Remove any non-numeric characters
            let expiryDate = input.value.replace(/\D/g, '');

            // Check the length of the input
            if (expiryDate.length > 2) {
                // Ensure the month part is in the "MM / YY" format
                expiryDate = expiryDate.slice(0, 2) + ' / ' + expiryDate.slice(2);
            }

            // Update the input field with the formatted expiry date
            input.value = expiryDate;
        }
    </script>


    <?php
    if (isset($_REQUEST['submit'])) {

        $up = "UPDATE `test` SET `fees_status`='Payment Completed' WHERE `tid`='$tid'";

        if ($conn->query($up) == TRUE) {
            echo "<script>alert('Payment Completed Successfully'); window.location = 'my_test.php';</script>";
        } else {
            echo "<script>alert('Failed'); window.location = 'view_bookings.php';</script>";
        }
    }


    ?>

</body>

</html>