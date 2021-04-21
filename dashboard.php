<?php
    // Initialize the session
    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    // Include config file
    require_once "./config.php";

    //pull overall data to feed dashboard widgets

?>

<!doctype html>
<html lang="en">
    <head>
        <title>IT Admin Dashboard</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="./img/logo.ico" type="image/ico">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        
        <!-- Custom Styles for this page-->
        <link href="./css/main.css" rel="stylesheet">
    </head>
    <body>
        
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <a class="navbar-brand" href="dashboard.php">
                <img src="./img/logo.ico">    
                UCSD#4 IT
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li name="full_name" class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="full_name">
                            <i class="fas fa-user-circle bi-xl mr-2"></i>
                            <?php echo $_SESSION["full_name"] ?>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <!-- <a class="dropdown-item" href="#">
                            <i class="bi bi-file-earmark-person bi-sm bi-fw mr-2 text-gray-400"></i>
                            Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear bi-sm bi-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-clock-history bi-sm bi-fw mr-2 text-gray-400"></i>
                                Activity Log
                                <div class="dropdown-divider"></div>
                            </a> -->
                            <a class="dropdown-item" href="./logout.php">
                                <i class="fas fa-sign-out-alt mr-4"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="container-fluid flex-grow-1" id="window">
            <div class="row h-100">
                
                <!-- sidebar - colapses on smaller screens -->
                <div class="col-lg-2 sidebar d-lg-block d-none bg-secondary p-0">
                    <div class="sidebar-container btn-group-vertical btn-group-justified">
                        <a class="btn btn-secondary btn-lg btn-block active text-left"  href="./dashboard.php" role="group">
                            <i class="fas fa-tachometer-alt mr-4"></i>
                            Dashboard
                        </a>
                        <div class="btn-group-vertical btn-group-justified" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle text-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-clipboard-list mr-4"></i>
                                Inventory
                            </button>
                            <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item text-left" href="./assets.html">
                                    <i class="fas fa-laptop mr-4"></i>
                                    Assets
                                </a>
                                <a class="dropdown-item text-left" href="./supplies.php">
                                    <i class="fas fa-fill-drip mr-4"></i>
                                    Supplies
                                </a>
                            </div>
                        </div>
                        <a class="btn btn-secondary btn-lg btn-block text-left" href="./reports.php" role="group">
                            <i class="fas fa-chart-bar mr-4"></i>
                            Reports
                        </a>
                    </div>
                </div>
        
                <!-- Content Area -->
                <div class="col-lg-10 bg-light">
                    <div class="container-fluid h-100">Content Area</div>
                </div>
            </div>
        </div>
      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>