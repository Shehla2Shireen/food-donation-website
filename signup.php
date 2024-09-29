<?php
include_once 'dbsh.inc.php';
//session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Sarala:wght@700&display=swap" rel="stylesheet">

    <!-- FOR BOOTSTRAP 4
    Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Food Links - Sign Up</title>
</head>

<body>


    <header class=".container-fluid" id="header">

        <div>
            <img src="images/logo.png" class="logo">
        </div>
        <div id="link">
            <a href="landing_page.php" class="link">Home</a>
            <a href="login.php" class="link">Login </a>
            <a href="" class="link">About us</a>
            <a href="" class="link">Contact</a>
        </div>

    </header>

    <div class="container logo py-3">
        <div class="row m-2">
            <div class="col">
                <img src="images/foodss.png" class="image">
            </div>
            <div id="signup-form" class="col login-form-2 ">
                <form action="" method="POST">
                    <h3 id="signup-heading">Sign Up</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="Full Name *" value="" name="name" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="Your Email *" value="" name="email" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="text-area" placeholder="Your Password *" value="" name="password" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="text-area" placeholder="Confirm Your Password *" value="" name="cpassword" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="Phone number *" name="phone" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="CNIC *" name="cnic" required>
                    </div>


                    <div class="form-check form-check-inline radio-btn">
                        <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="Donor" required>
                        <label class="form-check-label" for="inlineRadio1">Donor</label>
                    </div>
                    <div class="form-check form-check-inline radio-btn">
                        <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Receiver" required>
                        <label class="form-check-label" for="inlineRadio2">Reciever</label>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Next" name="submit" required />
                    </div>

                </form>
                <?php


                if (isset($_POST['submit'])) {

                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn,md5($_POST['password']));
                    $cpassword = mysqli_real_escape_string($conn,md5($_POST['cpassword']));
                    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $type = mysqli_real_escape_string($conn, $_POST['type']);




                    $sql1 = "SELECT * FROM person WHERE Email='$email' OR cnic='$cnic' or phone='$phone';";

                    if (!$result = $conn->query($sql1)) {
                        echo "<p>Error2 occured</p>";
                    } else {
                        if (mysqli_num_rows($result) > 0) {
                            echo  "<div class='alert alert-danger'>Error: This person already exist</div>";
                        } else {
                            if ($cpassword == $password) {

                                $sql = "INSERT INTO `person` (`p_id`, `Name`, `Email`, `Password`, `CNIC`, `Phone`, `Type`) VALUES (NULL, '$name', '$email', '$password', '$cnic','$phone','$type');";

                                if (!$conn->query($sql)) {
                                    echo "<p>Error1 occured</p>";
                                } else {
                                   

                                    

                                        $_SESSION['type'] = $_POST['type'];
                                        $_SESSION['email'] = $_POST['email'];

                                        header("Location: http://localhost/food%20donation1/address.php", true);
                                        echo "<script>window.top.location='http://localhost/food%20donation1/address.php'</script>";
                                        exit();
                                    
                                    // if (!$result = $conn->query($sql1)) {
                                    //     echo "<p>Error2 occured</p>";
                                    // } else {
                                    //     $resultcheck = mysqli_num_rows($result);
                                    //     while ($row = mysqli_fetch_assoc($result)) {
                                    //         echo "Your id is: " . $row['id'];
                                    //     }
                                    // }
                                }
                            } else
                                echo "<div class='alert alert-danger'>Error:Password does not match</div>";
                        }
                    }
                }

                ?>

            </div>

        </div>

    </div>


    <footer class="page-footer font-small blue">

        <div class="footer-bg footer-copyright text-center py-3">© 2022 Copyright:
            <a href="landing_page.html"> Food Links - Share it!</a>
        </div>

    </footer>


</body>


</html>