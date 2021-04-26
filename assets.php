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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.1/css/searchPanes.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.3/css/colReorder.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"></link> -->
        <link rel="stylesheet" href="./css/main.css">
        
    </head>
    <body>
        
        <!-- Bulk Upload Modal -->
        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Upload from Excel/CSV
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate>
                            <div class="custom-file">
                                <input type="file" accept=".xlsx,.csv" class="custom-file-input" id="validatedCustomFile" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose File...</label>
                                <div class="invalid-feedback">Invalid file or file type. Please try again.</div>
                            </div>
                        </form>
                    </div>
                </div>            
            </div>
        </div>

        <!-- Top Navbar  -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
            <a class="navbar-brand" href="dashboard.php">
                <img src="./img/logo.ico">    
                UCSD#4 IT
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
            
                <ul class="navbar-nav">
                    <!-- Navebar items to show when sidebar is collapsed -->
                    <li class="nav-item">
                        <a class="nav-link active" href="./assets.php">
                            <i class="fas fa-laptop fa-fw mr-4"></i>
                            Assets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./supplies.php">
                            <i class="fas fa-fill-drip fa-fw mr-4"></i>
                            Supplies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-left" href="./reports.php">
                            <i class="fas fa-chart-bar fa-fw mr-4"></i>
                            Reports
                        </a>
                    </li>
                </ul>
            
                <!-- User profile dropdown -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li name="full_name" class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="full_name">
                            <i class="fas fa-user-circle fa-lg mr-2"></i>
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
                                <i class="fas fa-sign-out-alt fa-fw mr-4"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="container-fluid flex-grow-1 bg-light h-100" id="window">
            
            <!-- DB Record options -->
            <div class="row m-2">
                <div class="btn-group">
                    <button class="btn btn-secondary">Add Record</button>
                    <button class="btn btn-secondary">Upload from Excel/CSV</button>
                </div>
            </div>

            <!-- Data Table -->
            <div class="row"> 
                <div class="container-fluid h-100">
                    <table id="asset_table" class="display pageResize h-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>Building</th>
                                <th>Room</th>
                                <th>Location</th>
                                <th>ID #</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Device Type</th>
                                <th>Serial #</th>
                                <th>SPED</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            

            <!-- sidebar - colapses on smaller screens -->
            <!-- <div class="sidebar d-lg-block d-none bg-secondary p-0">
                <div class="sidebar-container btn-group-vertical btn-group-justified">
                    <a class="btn btn-secondary btn-lg btn-block active text-left"  href="./dashboard.php" role="group">
                        <i class="fas fa-tachometer-alt fa-fw mr-4"></i>
                        Dashboard
                    </a>
                    <div class="btn-group-vertical btn-group-justified" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle text-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-clipboard-list fa-fw mr-4"></i>
                            Inventory
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item text-left" href="./assets.php">
                                <i class="fas fa-laptop fa-fw mr-4"></i>
                                Assets
                            </a>
                            <a class="dropdown-item text-left" href="./supplies.php">
                                <i class="fas fa-fill-drip fa-fw mr-4"></i>
                                Supplies
                            </a>
                        </div>
                    </div>
                    <a class="btn btn-secondary btn-lg btn-block text-left" href="./reports.php" role="group">
                        <i class="fas fa-chart-bar fa-fw mr-4"></i>
                        Reports
                    </a>
                </div>
            </div>
        </div> -->
      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.24/features/pageResize/dataTables.pageResize.min.js"></script>
        <script src="https://cdn.datatables.net/searchpanes/1.2.1/js/dataTables.searchPanes.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/colreorder/1.5.3/js/dataTables.colReorder.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> -->
        <script type="text/javascript" src="./js/assets.js"></script>
    </body>
</html>