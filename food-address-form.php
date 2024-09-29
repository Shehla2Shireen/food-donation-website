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
                    <h3 id="signup-heading">Confirm Address</h3>
                    <?php
                    $sql = "SELECT * from donor where d_id= {$_SESSION['d_id']};";

                    if ($result = $conn->query($sql)) {

                        while ($row = mysqli_fetch_assoc($result)) {
                            $GLOBALS['house'] = $row['house_no'];
                            $GLOBALS['street'] = $row['street'];
                            $GLOBALS['city'] = $row['city'];
                        }
                    } else {

                        echo "<div>Error occured</div>";
                    }
                    ?>

                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="House No *" value="<?php echo $GLOBALS['house']
                                                                                                                ?>" name="house" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="Street *" value="<?php echo $GLOBALS['street']
                                                                                                                ?>" name="street" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text-area" placeholder="City *" name="city" value="<?php echo $GLOBALS['city']
                                                                                                                        ?>" required>

                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Next" name="submit-address" required />
                    </div>



                </form>

                <?php
                if (isset($_POST['submit-address'])) {
                    $house = $_POST['house'];
                    $street = $_POST['street'];
                    $city = $_POST['city'];
                    $sql = "UPDATE `donor` SET `house_no` = '$house', `street` = '$street', `city` = '$city' where p_id= (select p_id from person where email = '{$_SESSION['$email']}')";


                    if (!$conn->query($sql)) {
                        echo "<div>Error occured</div>";
                    } else {
                        echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-donor.php'</script>";
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