<?php   
    include_once '../config/config.php';

    //getting form data
    $data = $_POST['data'];

    $rowID = $data['row'];
    
    $update = '';

    if($rowID != $data['id']) {
        $update = 'UPDATE assets SET asset_name ="' . $data['name'] . '",';     
    } else {
        $update = 'UPDATE assets SET asset_tag ="' . $data['id'] . '",';
    }

    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '",';
    $update += '' . $data[''] . '" ';
    $update += 'WHERE asset_tag = ' . $rowID . ';';


?>