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
    //if (!isset($_SESSION['$email'])) {
      //  echo "<script>window.top.location='http://localhost/food%20donation1/landing_page.php'</script>";
    //}
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

    </div>

    <?php
        $sql = "SELECT Status from rider where Rider_id = (Select Rider_id from rider where p_id = (SELECT p_id from person where email = '{$_SESSION['$email']}'));";
        if(!$isBusy = $conn->query($sql))
            echo "idhr";
        else
        {
            $status = "";
            while ($row = mysqli_fetch_assoc($isBusy)) {
                $status = $row['Status'];
               // $_SESSION['d_id'] = $row['d_id'];
            }

            if($status == 'Busy')
            {
                echo "
                <div class='d-flex justify-content-around'>
                <form method='POST'><button type='submit' class = 'btn btn-danger' name='notd' value=''/>Not Delivered</button>
                <button type='submit' class = 'btn btn-success ' name='deliver' value=''/>Delivered</button></form>
                </div><br>";
                if(isset($_POST['notd'])){
                    echo "hello";
                    $sql="UPDATE food SET Availability='pending' where food_id='{$_SESSION['food_id']}'";

                    if($conn->query($sql)){
                        $sql="UPDATE rider SET Status='Availaible' where p_id = (select p_id from person where email = '{$_SESSION['$email']}')";
                        if(!$conn->query($sql)){
                            echo "Error Occurred";
                        }
                        else{
                            echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-rider.php'</script>";
                        }
                    }
                    else{
                        echo "<div>Error Occurred</div>";
                    }
                }
                else if (isset($_POST['deliver'])) {
                    $sql = "UPDATE food SET Availability='Donated' where food_id='{$_SESSION['food_id']}'";
                    if ($conn->query($sql)) {
                        $sql = "UPDATE rider SET Status='Availaible' where p_id = (select p_id from person where email = '{$_SESSION['$email']}')";
                        if (!$conn->query($sql)) {
                            echo "Error Occurred";
                        }
                        else {
                            $sql = "SELECT rider_id from rider where p_id = (select p_id from person where email = '{$_SESSION['$email']}')";
                   echo $sql;
                            if ($result = $conn->query($sql)) {
                   
                                while ($row = mysqli_fetch_assoc($result)) {
                   
                                    $rid = $row['rider_id'];
                                }
                                $sql = "INSERT INTO `delivery` (`Deliver_id`, `Rider_id`, `food_id`, `Time`) VALUES (NULL, $rid, {$_SESSION['food_id']}, current_timestamp());";
                   
                                if ($conn->query($sql)) {
                                    echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-rider.php'</script>";
                                }
                                else{
                                    echo "eee";
                                }
                            }
                            else{
                                echo "qqqq";
                            }
                        }
                    }
                    else{
                        echo "<div>Error Occurred</div>";
                    }
                
            }}
            else
            {
                echo "<div class='container py-4' >
                <p class='foodh'>Current Orders</p>
                <table class='table'>
        
        
        
                    <thead class='thead' id='tableheading'>
                        <tr>
                            <th scope='col' id='th' >#</th>
                            <th scope='col' id='th'>Food Name</th>
                            <th scope='col' id='th'>From</th>
                            <th scope='col' id='th'>To</th>
                            <th scope='col' id='th'>Approval</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $sql = "SELECT city from rider where p_id = (select p_id from person where email = '{$_SESSION['$email']}')";
                
                    if ($result = $conn->query($sql)) {
    
                        while ($row = mysqli_fetch_assoc($result)) {
                            $city_rider = $row['city'];
                          
                        }
    
                    $sql = "SELECT * from food where d_id IN (select d_id from donor where city = '$city_rider' AND availability = 'Requested');";    
    
                        if (!$result = $conn->query($sql)) {
                            echo "<div>Error occured</div>";
                        } else {
                            if (mysqli_num_rows($result) > 0) {
                                $sr = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                
                                    echo "<tr>";
                                    echo "<th class = 'serial-no' scope='row'>" . $sr . "</th>";
                                    echo "<td>".$row['Name']."</td>";
                                        $id = $row['Food_id'];
                                        $donor_address = "SELECT house_no, street from donor where d_id IN (Select d_id from food where Food_id=$id)";
                                        $receiver_address = "SELECT house_no, street from receiver where r_id IN (Select r_id from food where Food_id=$id)";
                                       // $receiver_address = "SELECT house_no, street from receiver where r_id IN (Select d_id from food where Food_id=$id)";
                                        if (!$result1 = $conn->query($donor_address)) {
                                            echo "<div>Error occured</div>";
                                        }
                                        if ($row1 = mysqli_fetch_assoc($result1)) 
                                        {
                                            echo "<td>House no: ".$row1['house_no'].", ".$row1['street']." street</td>";
                                        }
    
                                        if(!$result2 = $conn->query($receiver_address))
                                        {
                                            echo "<div>Error occured</div>";
                                        }
                                        if ($row2 = mysqli_fetch_assoc($result2)) 
                                        {
                                            echo "<td>House no: ".$row2['house_no'].", ".$row2['street']." street</td>";
                                        }
                                    
                                    
                                    echo "<form method='POST'><td><button type='submit' class = 'btn btn-success' onclick='(this.className=\"btn btn-secondary\")' name='req-btn' value='$id'/>Accept</button></td></form>";
                                    echo "</tr>";
                                    $sr++;
                                }
    
                            }
                            else
                            {
                                echo "<td><div class='no-record'>No result found!</div></td>";
                            }
                        }
                    }
                    else
                    echo "<div>Error occured in mysql</div>";
    
                    if(isset($_POST['req-btn'])){
                       $id =  $_POST['req-btn'];
                       $_SESSION['food_id']=$id;
                       $sql = "UPDATE `food` SET `Availability` = 'Delivering' WHERE `food`.`Food_id` = $id;";
                       if($conn->query($sql))
                       {
                        $sql = "UPDATE `rider` SET `Status` = 'Busy' WHERE `rider`.`Rider_id` = (Select Rider_id from rider where p_id =  (SELECT p_id from person where email = '{$_SESSION['$email']}'));";
                        if($conn->query($sql))
                             echo "<script>window.top.location='http://localhost/food%20donation1/dashboard-rider.php'</script>";
                       }
                    }
                    
                echo"</tbody>
                    </table>
                </div>";

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