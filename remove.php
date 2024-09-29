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
            <div class="col login-form-2 " id="login-form">
                <form action="" method="POST">
                    <h3 id="signup-heading">Remove</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="Enter CNIC" value="" name="cnic" required />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btnSubmit btn-danger" value="Remove" name="submitn">
                    </div>

                </form>
                <?php
                if (isset($_POST['submitn'])) {



                    $cnic = mysqli_real_escape_string($conn, $_POST['cnic']);
                    $sql = "SELECT * FROM `person` WHERE `person`.`cnic` = '$cnic';";

                    if (!$result = $conn->query($sql)) {
                        echo "<p>Error occured</p>";
                    } else {
                        if (mysqli_num_rows($result) == 0) {
                            echo "<div class='alert alert-danger'>Error: Person does not exist. Please try again.</div>";
                        } else {
                            $sql = "DELETE FROM `person` WHERE `person`.`cnic` = '$cnic'";
                            if (!$result = $conn->query($sql)) {
                                echo "<p>Error occured</p>";
                            } else {
                                //Admin dashboard
                                header("Location: http://localhost/food%20donation1/dashboard-admin.php", true);
                                echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-admin.php'</script>";
                            }
                        }
                    }



                    $conn->close();
                }
                ?>
            </div>

        </div>
    </div>

    <footer class="page-footer font-small blue">

        <div class="footer-bg footer-copyright text-center py-3">© 2022 Copyright:
            <a href="landing_page.php"> Food Links - Share it!</a>
        </div>

    </footer>


</body>


</html>