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



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Sarala:wght@700&display=swap" rel="stylesheet">

    <!-- FOR BOOTSTRAP 4
    Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="landing_page.css">
    <link rel="stylesheet" type="text/css" href="dashboard.css">

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


            <!--<a href="landing_page.php" class=" btn btn-primary" id="btn-join">Logout</a>  -->

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

    <div class="first" id="first">
        <img src="images/foodss.png" alt="" class="image">
        <div class="container1">
            <p id="heading1" class="container-fluid">&nbsp;Food donation</p>
            <p class="tagline">Its better to share than waste</p>
            <p class="tagline description">Share food with the people who are in need because its better to share than waste. Our website will deliver your extra food to people who needed it the most.</p>
        </div>

        <form class="form-group container logo py-3 " method="POST">
            <input type="submit" class=" btn btn-primary" id="btn-join" name="donate" value="Donate now" />

        </form>
        <?php
        if (isset($_POST['donate'])) {
            echo "<script>window.top.location='http://localhost/food%20donation1/food-form.php'</script>";
        }
        ?>


    </div>

    <div class="container py-4" >
        <p class="foodh">Food History</p>
        <table class="table">



            <thead class="thead" id="tableheading">
                <tr>
                    <th scope="col" id="th" >#</th>
                    <th scope="col" id="th">Food Name</th>
                    <th scope="col" id="th">Type</th>
                    <th scope="col" id="th">Availability</th>
                </tr>
            </thead>
            <tbody>
                <?php


                $sql = "SELECT d_id from donor where p_id= (select p_id from person where email = '{$_SESSION['$email']}')";


                if ($result = $conn->query($sql)) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['d_id'] = $row['d_id'];
                    }
                    $sql = "SELECT * FROM food WHERE d_id='{$_SESSION['d_id']}';";

                    if (!$result = $conn->query($sql)) {
                        echo "<div>Error occured</div>";
                    } else {
                        if (mysqli_num_rows($result) > 0) {
                            $sr = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $sr . "</th>";
                                echo "<td>".$row['Name']."</td>";
                                echo "<td>".$row['Type']."</td>";
                                echo "<td>".$row['Availability']."</td>";

                                echo "</tr>";
                                $sr++;
                            }
                        }else
                        {
                            echo "<td><div class='no-record'>No result found!</div></td>";
                        }
                    }
                }
                ?>





            </tbody>
        </table>
    </div>


    <footer class="page-footer font-small blue">

        <div class="footer-bg footer-copyright text-center py-3">© 2022 Copyright:
            <a href="landing_page.html"> Food Links - Share it!</a>
        </div>

    </footer>


</body>


</html>