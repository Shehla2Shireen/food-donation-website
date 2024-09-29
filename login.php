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
    <title>Food Links - Login</title>
</head>

<body>


    <header class=".container-fluid" id="header">

        <div>
            <img src="images/logo.png" class="logo">
        </div>
        <div id="link">
            <a href="landing_page.php" class="link">Home</a>
            <a href="" class="link">About us</a>
            <a href="" class="link">Contact</a>
        </div>

    </header>

    <div class="container logo py-3">

        <div class="row m-1">
            <div class="col">
                <img src="images/foodss.png" class="image">
            </div>
            <div class="col login-form-2 " id="login-form">
                <form action="" method="POST">
                    <h3>Login</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="Your Email *" value="" name="email" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="text-area" placeholder="Your Password *" value="" name="password" required />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" name="submit" />
                    </div>
                    <div class="form-group ml-2">
                        <a href="signup.php" class="btnForgetPwd">Not have an account? Create one</a>
                    </div>
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn, md5($_POST['password']));



                    $sql = "SELECT * FROM person WHERE email='$email';";

                    if (!$result = $conn->query($sql)) {
                        echo "<p>Error occured</p>";
                    } else {
                        if (mysqli_num_rows($result) == 0) {
                            echo "<div class='alert alert-danger'>Error: Incorrect email. Please try again.</div>";
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {

                                $type=$row['Type'];
                                $dpass = $row['Password'];
                            }
                            if (md5($password) == md5($dpass)) {
                                $_SESSION['$email']=$email;
                            
                                
                               if($type=="Donor"){
                                   //donor dashboard
                                header("Location: http://localhost/food%20donation1/dashboard-donor.php", true);
                                echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-donor.php'</script>";
                               }
                               else if($type=="Receiver"){
                                header("Location: http://localhost/food%20donation1/dashboard-receiver.php", true);
                                echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-receiver.php'</script>";
                               }
                               else if($type=="Admin"){
                                //Admin dashboard
                                header("Location: http://localhost/food%20donation1/dashboard-admin.php", true);
                                echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-admin.php'</script>";
                               }
                               else if($type=="Rider"){
                                header("Location: http://localhost/food%20donation1/dashboard-rider.php", true);
                                echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-rider.php'</script>";
                               }

                               exit();

                            } else {
                                echo  "<div class='alert alert-danger'>Error: Incorrect password. Please try again.</div>";
                            }
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