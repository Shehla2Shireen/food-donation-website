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
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="dashboard.css">

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
    <title>Food Links - Admin</title>
</head>

<body>


    <header class=".container-fluid" id="header">

        <div>
            <img src="images/logo.png" class="logo">
        </div>
        <div id="link">
     
            <a href="landing_page.php" class=" btn btn-primary" id="btn-join">Logout</a>
        </div>

    </header>

    

    <div class="container logo py-3">
        <div class="row m-2">
            <div class="col">
                <img src="images/foodss.png" class="image">
            </div>
            <div   class="col" id="adminoptions">
                <form action="" method="Post">
                <div class="form-group">
                    <input type="submit" class="btnSubmit btn-success" value="Insert a rider" name="iri" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit btn-danger" value="Remove a rider" name="rri"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit btn-danger" value="Remove a Donor" name="rdo"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit btn-danger" value="Remove a Reciever" name="rrc" />
                </div>

                </form>
                <?php
                    if(isset($_POST['iri'])){echo "<script>window.top.location='http://localhost/food%20donation1/rider-signup1.php'</script>"; }


                    else if(isset($_POST['rri']) || isset($_POST['rdo'])||isset($_POST['rrc'])){
                        echo "<script>window.top.location='http://localhost/food%20donation1/remove.php'</script>";
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