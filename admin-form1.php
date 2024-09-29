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
    <title>Food Links - Share it!</title>
</head>

<body>

    <?php
    if (!isset($_SESSION['$email'])) {
        echo "<script>window.top.location='http://localhost/food%20donation1/landing_page.php'</script>";
    }
    ?>
    <header class=".container-fluid" id="header">

        <div>
            <img src="images/logo.png" class="logo">
        </div>
        <div id="link">
            <form action="" method="POST">
                <input type="submit" class=" btn btn-primary" id="btn-join" name="logout" value="Logout" name="logout" />
            </form>
            <?php
            if (isset($_POST['logout'])) {
                session_unset();
                echo "<script>window.top.location='http://localhost/food%20donation1/landing_page.php'</script>";
            }
            ?>

        </div>

    </header>


    <div class="container logo py-3">
        <div class="row m-2">
            <div class="col">
                <img src="images/foodss.png" class="image">
            </div>
            <div id="signup-form" class="col login-form-2 ">
                <form action="" method="POST">
                    <h3 id="signup-heading">Donate Now</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="Food Name *" value="" name="fname" required />
                    </div>

                    <div class="form-group">
                        <div id="label1">
                            <label for="cars" style="color:#fff; font-size:20px">Choose a Type<label>
                        </div>
                        <div>

                            <select name="food-type" class="form-control" id="text-area">
                                <option value="Home-made">Home-made</option>
                                <option value="Desi">Desi</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Chinese">Indian</option>
                                <option value="Other">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input placeholder="Expiry Date" class="form-control" type="text" onfocus="(this.type='date')" id="text-area" name="exp" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Next" name="submit-food" required />
                    </div>

                </form>


            </div>

        </div>
    </div>

    <?php
    if (isset($_POST['submit-food'])) {
        $fname = $_POST['fname'];
        $type = $_POST['food-type'];
        $exp = $_POST['exp'];
        $sql = "SELECT d_id from donor where p_id= (select p_id from person where email = '{$_SESSION['$email']}')";


        if ($result = $conn->query($sql)) {

            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['d_id'] = $row['d_id'];
            }
            $sql = "INSERT INTO `food` (`Food_id`, `Name`, `Type`, `Expiry`, `Availability`, `d_id`) VALUES (NULL, '$fname', '$type', '$exp', 'true', '{$_SESSION['d_id']}');";

            if (!$conn->query($sql)) {
                echo "<div>Error occured</div>";
            } else {
                echo "<script>window.top.location='http://localhost/food%20donation1/food-address-form.php'</script>";
            }
        } else {

            echo "<div>Error occured</div>";
        }
    }
    ?>


    <footer class="page-footer font-small blue">

        <div class="footer-bg footer-copyright text-center py-3">© 2022 Copyright:
            <a href="landing_page.html"> Food Links - Share it!</a>
        </div>

    </footer>


</body>


</html>