<?php
include_once 'config.php';

$return_arr = array();

$sql = "SELECT buildings.building_name, assets.asset_tag, assets.asset_name, assets.asset_serial, assets.asset_sped_tag, logistics.device_status FROM assets
        LEFT JOIN logistics ON logistics.asset_tag = assets.asset_tag
        LEFT JOIN rooms ON rooms.id = logistics.room_id
        LEFT JOIN buildings ON buildings.id = rooms.building_id
ORDER BY asset_tag";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0) {
        
        while($row = mysqli_fetch_array($result)){
            $building_name = $row['building_name'];
            $asset_tag = $row['asset_tag'];
            $asset_name = $row['asset_name'];
            $asset_serial = $row['asset_serial'];
            $asset_sped_tag = $row['asset_sped_tag'];
            $device_status = $row['device_status'];

            $return_arr[] = array(
                "loc" => $building_name,
                "id" => $asset_tag,
                "name" => $asset_name,
                "serial" => $asset_serial,
                "sped" => $asset_sped_tag,
                "status" => $device_status,
                "actions" => '<a href="update.php?id' . $asset_tag . '" class="mr-3 title="View" data-toggle="tooltip"><span class="fas fa-external-link-alt mr-2"></span></a> <a href="delete.php?id' . $asset_tag . '" class="mr-3 title="Delete" data-toggle="tooltip"><span class="fas fa-trash-alt mr-2"></span></a>'
            );
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
mysqli_close($link);

// return JSON string
echo json_encode(array('data' => $return_arr));
?>