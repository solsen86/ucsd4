<?php 
    //DO NOT REMOVE
    session_start();

    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Inventory</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="./img/logo.ico" type="image/ico">

        <!-- Bootstrap & CSS -->
        <link rel="stylesheet" href="./css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        
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
                            <?php echo $_SESSION["full_name"] ?>
                            <i class="bi bi-person-circle bi-xl ml-2"></i>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
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
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./logout.php">
                                <i class="bi bi-box-arrow-left"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid" id="window">
            <div class="row h-100">
                <div class="col-lg-2 h-100 bg-secondary p-0">
                    <div class="btn-group-vertical btn-group-justified">
                        <a class="btn btn-secondary btn-lg btn-block active"  href="./dashboard.php" role="group">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                        <div class="btn-group-vertical btn-group-justified" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Inventory
                            </button>
                            <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="assets.php">Assets</a>
                                <a class="dropdown-item" href="supplies.php">Supplies</a>
                            </div>
                        </div>
                        <a class="btn btn-secondary btn-lg btn-block" href="reports.php" role="group">
                            Reports
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 bg-light h-100" id="window">
                    <div class="container-fluid">
                        <table id="asset_table" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>Name</th>
                                    <th>Serial #</th>
                                    <th>SPED</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php // Include config file
                                require_once "./config.php";

                                $sql = "SELECT * FROM assets ORDER BY asset_tag";
                                if($result = mysqli_query($link, $sql)){
                                    if(mysqli_num_rows($result) > 0) {
                                        
                                            while($row = mysqli_fetch_array($result)){
                                                echo '<tr>';
                                                    echo '<td>' . $row['asset_tag'] . '</td>';
                                                    echo '<td>' . $row['asset_name'] . '</td>';
                                                    echo '<td>' . $row['asset_serial'] . '</td>';
                                                    echo '<td>' . $row['asset_sped_tag'] . '</td>';
                                                    echo '<td>';
                                                        echo '<a href="update.php?id' . $row['asset_tag'] . '" class="mr-3 title="Edit" data-toggle="tooltip"><span class="fas fa-edit mr-2"></span></a>';
                                                        echo '<a href="update.php?id' . $row['asset_tag'] . '" class="mr-3 title="Delete" data-toggle="tooltip"><span class="fas fa-trash-alt mr-2"></span></a>';
                                                    echo '</td>';
                                                echo '</tr>';
                                            }
                                        // Free result
                                        mysqli_free_result($result);
                                        } else {
                                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                    }
                                } else {
                                    echo 'Oops! Something went wrong. Please try again later.';
                                }

                                // close connection
                                mysqli_close($link)
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="./js/assets.js"></script>
    </body>
</html>