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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/main.css">
    </head>
    <body>
        
        <!-- Top Navbar  -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="./assets.php">
                    <img src="./img/logo.ico">    
                    Information Technology
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" 
                    aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigations">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <ul class="navbar-nav">
                <!--    <li class="nav-item">
                        <a class="nav-link active" href="./assets.php">
                            <i class="fas fa-laptop fa-fw mx-2"></i>
                            Assets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./supplies.php">
                            <i class="fas fa-fill-drip fa-fw mx-2"></i>
                            Supplies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-left" href="./reports.php">
                            <i class="fas fa-chart-bar fa-fw mx-2"></i>
                            Reports
                        </a>
                    </li>w
                </ul> -->
            
                <!-- User profile dropdown -->
                    
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown right ms-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="full_name">
                            <i class="fas fa-user-circle fa-lg mr-2"></i>
                            <?php echo $_SESSION["full_name"] ?>
                        </a>
                        <!-- Dropdown - User Information -->
                        <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
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
                            <li class="dropdown-item" href="#">
                                <a class="dropdown-item" href="./logout.php">
                                    <i class="fas fa-sign-out-alt fa-fw mr-4"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="container-fluid bg-light" id="window">
            <div id="result" class="alert-fixed"></div>
            <!-- DB Record options -->
            <div class="container-fluid my-3 pt-3 px-0">
                <button class="btn btn-outline-secondary mr-2" data-bs-toggle="modal" data-bs-target="#addNew"><i class="fas fa-plus mr-2"></i>Add Record</button>
                <button class="btn btn-outline-secondary mr-2" data-bs-toggle="modal" data-bs-target="#fileUpload"><i class="fas fa-file-csv mr-2"></i>Upload from CSV</button>
            </div>
            <!-- Data Table -->
            <div class="text-nowrap table-container">
                <table id="table" class="table table-striped table-hover table-responsive-sm table-bordered">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="bldg">Building</th>
                            <th data-field="room">Room</th>
                            <th data-field="loc">Location</th>
                            <th data-field="name">Name</th>
                            <th data-field="brand">Brand</th>
                            <th data-field="model">Model</th>
                            <th data-field="type">Type</th>
                            <th data-field="sn">SN</th>
                            <th data-field="os">OS</th>
                            <th data-field="cpu">CPU</th>
                            <th data-field="s_type">Storage Type</th>
                            <th data-field="s_size">Storage Size</th>
                            <th data-field="mem">RAM</th>
                            <th data-field="ip">IP Address</th>
                            <th data-field="wlan">WLAN MAC</th>
                            <th data-field="lan">LAN MAC</th>
                            <th data-field="bios">BIOS Pwd.</th>
                            <th data-field="sped">SPED</th>
                            <th data-field="age">Age</th>
                            <th data-field="date">Purchase Date</th>
                            <th data-field="price">Price</th>
                            <th data-field="status">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Bulk Upload Modal -->
        <div class="modal fade" tabindex="-1" id="fileUpload" role="dialog">
            <div class="modal-dialog" role="dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Upload from CSV
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadCsv" name="uploadCsv" enctype="multipart/form-data">
                            <div class="custom-file mb-3">   
                                <input type="file" accept=".csv" class="form-control" id="file" name="file" required>
                            </div>
                            <div>
                                <button class="btn btn-success my-2 ml-2 float-right upload-csv" type="submit" id="uploadBtn" name="submit"><i class="fas fa-file-import mr-2"></i>Upload File</button>
                                <button class="btn btn-outline-secondary my-2 float-right" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>            
            </div>
        </div>
        
        <!-- New Record Modal -->
        <div class="modal fade" tabindex="-1" id="addNew" role="dialog">
            <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Add New Record
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation add-new" id="addForm" novalidate>
                            <div class="row mb-3">
                                <div class="form-floating col-2">
                                    <input type="number" class="form-control" name="id" placeholder="District ID" required />
                                    <label  for="id">District ID</label>
                                </div>
                                <div class="form-floating col-5">
                                    <input type="text" class="form-control" name="name" placeholder="Device Name"/>
                                    <label  for="name">Device Name</label>
                                </div>
                                <div class="form-floating col -3">
                                    <select class="form-select" name="status" required>
                                        <option></option>
                                        <option value="In Service">In Service</option>
                                        <option value="Out of Service">Out of Service</option>
                                        <option value="Recycle List">Recycle List</option>
                                    </select>
                                    <label  for="status">Device Status</label>
                                </div>
                                <div class="col-2 text-center">
                                    <input type="checkbox" class="form-check-input" id="spedCheck" name="sped">
                                    <label class="form-check-label" for="sped">SPED</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-floating col-2">
                                    <select class="form-select" name="bldg" required>
                                        <option></option>
                                        <option value="HS">HS</option>
                                        <option value="K8">K8</option>
                                        <option value="DO">DO</option>
                                        <option value="BB">BB</option>
                                    </select>
                                    <label  for="bldg">Building</label>
                                </div>
                                <div class="form-floating col-5">
                                    <input type="text" class="form-control" placeholder="Room" name="room" required />
                                    <label  for="room">Room</label>
                                </div>
                                <div class="form-floating col-5">
                                    <input type="text" class="form-control" placeholder="Location (optional)" name="loc" />
                                    <label  for="loc">Location (optional)</label>
                                </div>
                            </div>
                            <h6 class="text-secondary">Device Information</h6>
                            <hr />
                            <div class="row mb-3">
                                <div class="form-floating col 3">
                                    <select class="form-select" name="type" required>
                                        <option></option>
                                        <option value="DESKTOP">Desktop</option>
                                        <option value="LAPTOP">Laptop</option>
                                        <option value="SERVER">Server</option>
                                        <option value="MOBILE DEVICE">Mobile Device</option>
                                        <option value="PRINTER">Printer</option>
                                        <option value="SCANNER">Scanner</option>
                                        <option value="DOC CAM">Doc Cam</option>
                                        <option value="PROJECTOR">Projectpr</option>
                                        <option value="INTERACTIVE BOARD">Interactive Board</option>
                                        <option value="ROUTER">Router</option>
                                        <option value="SWITCH">Switch</option>
                                        <option value="WIRELESS AP">Wireless AP</option>
                                        <option value="NAS">NAS</option>
                                        <option value="DEVICE CART">Device Cart</option>
                                    </select>
                                    <label  for="type">Device Type</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control" placeholder="Brand" name="brand" required/>
                                    <label  for="brand">Brand</label>
                                </div> 
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control" placeholder="Model" name="model" required/>
                                    <label  for="model">Model</label>
                                </div> 
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control" placeholder="Serial #" name="sn" required/>
                                    <label  for="sn">Serial #</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" name="bios" placeholder="BIOS Password"/>
                                    <label  for="bios">BIOS Password</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input type="date" class="form-control" placeholder="Purchase Date" name="date" />
                                    <label for="date" >Purchase Date</label>
                                </div>
                                <div class="col-2">
                                    <label for="price" >Price</label>    
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="price" name="price" placeholder="0.00" /> 
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-secondary">Tech Specs</h6>
                            <hr />
                            <div class="row mb-3">
                                <div class="form-floating col-3">
                                    <select class="form-select" name="os">
                                        <option value=""></option>
                                        <option value="Windows">Windows</option>
                                        <option value="MacOS">MacOS</option>
                                        <option value="Linux">Linux</option>
                                        <option value="Android">Android</option>
                                        <option value="iOS">iOS/iPadOS</option>
                                        <option value="ChromeOS">ChromeOS</option>
                                    </select>
                                    <label  for="os">OS</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input class="form-control" type="text" name="cpu" placeholder="i7-8650U">
                                    <label  for="cpu">CPU</label>
                                </div>
                                <div class="form-floating col-2">
                                    <select class="form-select" name="s_type">
                                        <option></option>
                                        <option value="SSD">SSD</option>
                                        <option value="SSHD">SSHD</option>
                                        <option value="HDD">HDD</option>
                                        <option value="eMMC">eMMC</option>
                                    </select>
                                    <label  for="s_type">Storage Type</label>
                                </div>
                                <div class="form-floating col-2">
                                    <input class="form-control" type="text" name="s_size" placeholder="0 GB" />
                                    <label  for="s_size">Storage Size</label>
                                </div>
                                <div class="form-floating col-2">
                                    <input class="form-control" type="text" name="mem" placeholder="0 GB" />
                                    <label  for="mem">RAM</label>
                                </div>
                            </div>
                            <h6 class="text-secondary">Network Info</h6>
                            <hr />
                            <div class="row mb-3">
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" placeholder="Wireless MAC Address" name="wlan"/>
                                    <label  for="wlan">Wireless MAC Address</label>
                                </div>
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" placeholder="Ethernet MAC Address" name="lan"/>
                                    <label  for="lan">Ethernet MAC Address</label>
                                </div>
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" placeholder="Static IP Address" name="ip"/>
                                    <label  for="ip">Static IP Address</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-end">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-lg btn-success add-record">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>            
            </div>
        </div>

        <!-- Edit Record Modal -->
        <div class="modal fade" tabindex="-1" id="editRecord" role="dialog">
            <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Edit Record
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation edit-record" id="editForm" novalidate>
                            <div class="row mb-3">
                                <div class="form-floating col-2">
                                    <input type="hidden" name="hidden_id" />
                                    <input type="number" class="form-control" name="id" placeholder="District ID" required />
                                    <label  for="id">District ID</label>
                                </div>
                                <div class="form-floating col-5">
                                    <input type="text" class="form-control" name="name" placeholder="Device Name"/>
                                    <label  for="name">Device Name</label>
                                </div>
                                <div class="form-floating col -3">
                                    <select class="form-select" name="status" required>
                                        <option></option>
                                        <option value="In Service">In Service</option>
                                        <option value="Out of Service">Out of Service</option>
                                        <option value="Recycle List">Recycle List</option>
                                    </select>
                                    <label  for="status">Device Status</label>
                                </div>
                                <div class="col-2 text-center">
                                    <input type="checkbox" class="form-check-input" id="spedCheck" name="sped">
                                    <label class="form-check-label" for="sped">SPED</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-floating col-2">
                                    <select class="form-select" name="bldg" required>
                                        <option></option>
                                        <option value="HS">HS</option>
                                        <option value="K8">K8</option>
                                        <option value="DO">DO</option>
                                        <option value="BB">BB</option>
                                    </select>
                                    <label  for="bldg">Building</label>
                                </div>
                                <div class="form-floating col-5">
                                    <input type="text" class="form-control" placeholder="Room" name="room" required />
                                    <label  for="room">Room</label>
                                </div>
                                <div class="form-floating col-5">
                                    <input type="text" class="form-control" placeholder="Location (optional)" name="loc" />
                                    <label  for="loc">Location (optional)</label>
                                </div>
                            </div>
                            <h6 class="text-secondary">Device Information</h6>
                            <hr />
                            <div class="row mb-3">
                                <div class="form-floating col 3">
                                    <select class="form-select" name="type" required>
                                        <option></option>
                                        <option value="DESKTOP">Desktop</option>
                                        <option value="LAPTOP">Laptop</option>
                                        <option value="SERVER">Server</option>
                                        <option value="MOBILE DEVICE">Mobile Device</option>
                                        <option value="PRINTER">Printer</option>
                                        <option value="SCANNER">Scanner</option>
                                        <option value="DOC CAM">Doc Cam</option>
                                        <option value="PROJECTOR">Projectpr</option>
                                        <option value="INTERACTIVE BOARD">Interactive Board</option>
                                        <option value="ROUTER">Router</option>
                                        <option value="SWITCH">Switch</option>
                                        <option value="WIRELESS AP">Wireless AP</option>
                                        <option value="NAS">NAS</option>
                                        <option value="DEVICE CART">Device Cart</option>
                                    </select>
                                    <label  for="type">Device Type</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control" placeholder="Brand" name="brand" required/>
                                    <label  for="brand">Brand</label>
                                </div> 
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control" placeholder="Model" name="model" required/>
                                    <label  for="model">Model</label>
                                </div> 
                                <div class="form-floating col-3">
                                    <input type="text" class="form-control" placeholder="Serial #" name="sn" required/>
                                    <label  for="sn">Serial #</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" name="bios" placeholder="BIOS Password"/>
                                    <label  for="bios">BIOS Password</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input type="date" class="form-control" placeholder="Purchase Date" id="purchaseDate"name="date" />
                                    <label for="date" >Purchase Date</label>
                                </div>
                                <div class="col-2">
                                    <label for="price" >Price</label>    
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="price" name="price" placeholder="0.00" /> 
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-secondary">Tech Specs</h6>
                            <hr />
                            <div class="row mb-3">
                                <div class="form-floating col-3">
                                    <select class="form-select" name="os">
                                        <option></option>
                                        <option value="Windows">Windows</option>
                                        <option value="MacOS">MacOS</option>
                                        <option value="Linux">Linux</option>
                                        <option value="Android">Android</option>
                                        <option value="iOS">iOS/iPadOS</option>
                                        <option value="ChromeOS">ChromeOS</option>
                                    </select>
                                    <label  for="os">OS</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input class="form-control" type="text" name="cpu" placeholder="i7-8650U">
                                    <label  for="cpu">CPU</label>
                                </div>
                                <div class="form-floating col-2">
                                    <select class="form-select" name="s_type">
                                        <option></option>
                                        <option value="SSD">SSD</option>
                                        <option value="SSHD">SSHD</option>
                                        <option value="HDD">HDD</option>
                                        <option value="eMMC">eMMC</option>
                                    </select>
                                    <label  for="s_type">Storage Type</label>
                                </div>
                                <div class="form-floating col-2">
                                    <input class="form-control" type="text" name="s_size" placeholder="0 GB" />
                                    <label  for="s_size">Storage Size</label>
                                </div>
                                <div class="form-floating col-2">
                                    <input class="form-control" type="text" name="mem" placeholder="0 GB" />
                                    <label  for="mem">RAM</label>
                                </div>
                            </div>
                            <h6 class="text-secondary">Network Info</h6>
                            <hr />
                            <div class="row mb-3">
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" placeholder="Wireless MAC Address" name="wlan"/>
                                    <label  for="wlan">Wireless MAC Address</label>
                                </div>
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" placeholder="Ethernet MAC Address" name="lan"/>
                                    <label  for="lan">Ethernet MAC Address</label>
                                </div>
                                <div class="form-floating col-4">
                                    <input type="text" class="form-control" placeholder="Static IP Address" name="ip"/>
                                    <label  for="ip">Static IP Address</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-end">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-lg btn-success update-record">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>            
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
        <script type="text/javascript" src="./js/assets.js"></script>
    </body>
</html>