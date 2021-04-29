<?php 
include "./config.php";

$asset_tag = 0;
if(isset($_POST['asset_tag'])){
   $asset_tag = mysqli_real_escape_string($con,$_POST['asset_tag']);
}
if($asset_tag > 0){

  // Check record exists
  $checkRecord = mysqli_query($con,"SELECT * FROM posts WHERE id=".$asset_tag);
  $totalrows = mysqli_num_rows($checkRecord);

  if($totalrows > 0){
    // Delete record
    $query = "DELETE FROM assets WHERE asset_tag=".$asset_tag;
    mysqli_query($con,$query);
    echo 1;
    exit;
  }else{
    echo 0;
    exit;
  }
}

echo 0;
exit;
?>