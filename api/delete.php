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
echo 1;
exit;
}else{
echo 0;
exit;
}

?>