<?php 
include_once "../config/config.php";

$asset_tag = mysqli_real_escape_string($link, $_POST['id']);

// Check record exists
$checkRecord = mysqli_query($link,"SELECT * FROM assets WHERE asset_tag=".$asset_tag);
$totalrows = mysqli_num_rows($checkRecord);

if($totalrows > 0){
    // Delete record
    $query = "DELETE FROM assets WHERE asset_tag=".$asset_tag;
    mysqli_query($link,$query);
    $toast[] = array(
        "message" => "Successfuly deleted device " . $asset_tag . " from the database!",
        "title" => "Success!"
    );
    echo json_encode($toast);;
    exit;
}else{
    $toast[] = array(
        "message" => "Failed to delete device " . $asset_tag . " from the database!",
        "class" => "Error!"
    );
    echo json_encode($toast);
    exit;
}

?>