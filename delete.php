<?php 
    require_once './config.php';

    $sql = "DELETE  assets FROM assets WHERE asset_tag = ?";

    if($stmt = mysqli_prepare($link, $sql)) {
        // Bind asset tag to prepared sql statement
        mysqli_stmt_bind_param($stmt, "i", $asset_tag);

        $asset_tag = trim($_POST['asset_tag']);
        
        if(mysqli_stmt_execute($stmt)){
            echo "Record with District ID " . $asset_tag . "" ;
        } else{
            echo "Opps! Something went wrong. Please try again later.";
            header("location: ./assets.php");
            exit();
        }

    // close statement
    mysqli_stmt_close($stmt);
    
    // close connection
    mysqli_close($link);
    }
?>